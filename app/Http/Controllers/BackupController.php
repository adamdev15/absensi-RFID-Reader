<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class BackupController extends Controller
{
    public function index()
    {
        $backupPath = public_path('backup');
        if (!File::exists($backupPath)) {
            File::makeDirectory($backupPath, 0755, true);
        }

        $files = File::files($backupPath);
        $backups = [];
        
        foreach ($files as $file) {
            $backups[] = [
                'name' => $file->getFilename(),
                'size' => round($file->getSize() / 1024 / 1024, 2) . ' MB',
                'date' => \Carbon\Carbon::createFromTimestamp($file->getMTime())->format('Y-m-d H:i:s'),
                'path' => $file->getPathname()
            ];
        }

        // Urutkan terbaru di atas
        usort($backups, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        return view('backup.index', compact('backups'));
    }

    public function create()
    {
        $backupPath = public_path('backup');
        if (!File::exists($backupPath)) {
            File::makeDirectory($backupPath, 0755, true);
        }

        $fileName = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $filePath = $backupPath . '/' . $fileName;

        $host = env('DB_HOST', '127.0.0.1');
        $port = env('DB_PORT', '3306');
        $user = env('DB_USERNAME', 'root');
        $pass = env('DB_PASSWORD', '');
        $dbName = env('DB_DATABASE', 'pcnu_absensi');

        // Gunakan mysqldump (Pastikan ada di environment path)
        $passStr = empty($pass) ? '' : "-p\"$pass\"";
        
        // Cek path mysqldump yang umum di Windows (XAMPP/Laragon) jika tidak ada di PATH
        $dumpCmd = 'mysqldump';
        if (File::exists('C:\xampp\mysql\bin\mysqldump.exe')) $dumpCmd = 'C:\xampp\mysql\bin\mysqldump.exe';
        
        $command = "\"{$dumpCmd}\" --user={$user} {$passStr} --host={$host} --port={$port} {$dbName} > \"{$filePath}\" 2>&1";
        
        exec($command, $output, $returnVar);

        if ($returnVar !== 0) {
            // Hapus file 0 byte jika gagal
            if (File::exists($filePath)) File::delete($filePath);
            $err = implode("\n", $output);
            return back()->with('error', "Gagal membuat backup. (Kode: {$returnVar}). Pesan: " . substr($err, 0, 150));
        }

        return back()->with('success', "Backup berhasil dibuat: {$fileName}");
    }

    public function restore($fileName)
    {
        $filePath = public_path('backup/' . $fileName);
        
        if (!File::exists($filePath)) {
            return back()->with('error', 'File backup tidak ditemukan.');
        }

        $host = env('DB_HOST', '127.0.0.1');
        $port = env('DB_PORT', '3306');
        $user = env('DB_USERNAME', 'root');
        $pass = env('DB_PASSWORD', '');
        $dbName = env('DB_DATABASE', 'pcnu_absensi');

        $passStr = empty($pass) ? '' : "-p\"$pass\"";
        
        $mysqlCmd = 'mysql';
        if (File::exists('C:\xampp\mysql\bin\mysql.exe')) $mysqlCmd = 'C:\xampp\mysql\bin\mysql.exe';

        $command = "\"{$mysqlCmd}\" --user={$user} {$passStr} --host={$host} --port={$port} {$dbName} < \"{$filePath}\" 2>&1";
        
        exec($command, $output, $returnVar);

        if ($returnVar !== 0) {
            $err = implode("\n", $output);
            return back()->with('error', "Gagal melakukan restore. (Kode: {$returnVar}). Pesan: " . substr($err, 0, 150));
        }

        return back()->with('success', "Data berhasil di-restore dari {$fileName}");
    }

    public function destroy($fileName)
    {
        $filePath = public_path('backup/' . $fileName);
        if (File::exists($filePath)) {
            File::delete($filePath);
            return back()->with('success', "File backup {$fileName} berhasil dihapus.");
        }
        return back()->with('error', 'File backup tidak ditemukan.');
    }

    public function download($fileName)
    {
        $file = public_path('backup/' . $fileName);
        if (File::exists($file)) {
            return response()->download($file);
        }
        return back()->with('error', 'File backup tidak ditemukan.');
    }
}
