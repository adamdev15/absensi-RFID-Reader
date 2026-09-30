<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with(['participant.utusan', 'participant.jabatan', 'participant.mwcnu', 'station'])->latest('attendance_at');

        // Filter berdasarkan tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('attendance_at', $request->start_date);
        }

        // Filter berdasarkan Station
        if ($request->filled('station_id')) {
            $query->where('station_id', $request->station_id);
        }

        // Filter berdasarkan tipe absensi (IN/OUT)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter berdasarkan pencarian nama
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('participant', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('participant_code', 'like', "%{$search}%");
            });
        }

        $attendances = $query->paginate(20)->withQueryString();
        $stations = \App\Models\Station::all();

        return view('reports.index', compact('attendances', 'stations'));
    }

    public function export(Request $request)
    {
        $query = Attendance::with(['participant.utusan', 'participant.jabatan', 'participant.mwcnu', 'station'])->orderBy('attendance_at', 'asc');

        if ($request->filled('start_date')) {
            $query->whereDate('attendance_at', $request->start_date);
        }
        if ($request->filled('station_id')) {
            $query->where('station_id', $request->station_id);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('participant', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")->orWhere('participant_code', 'like', "%{$search}%");
            });
        }

        $attendances = $query->get();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Header
        $sheet->setCellValue('A1', 'Waktu');
        $sheet->setCellValue('B1', 'Peserta');
        $sheet->setCellValue('C1', 'Utusan');
        $sheet->setCellValue('D1', 'Jabatan');
        $sheet->setCellValue('E1', 'MWCNU');
        $sheet->setCellValue('F1', 'Tipe');
        $sheet->setCellValue('G1', 'Station');

        $row = 2;
        foreach ($attendances as $att) {
            $sheet->setCellValue('A' . $row, \Carbon\Carbon::parse($att->attendance_at)->format('Y-m-d H:i:s'));
            $sheet->setCellValue('B' . $row, $att->participant_name_snapshot ?? ($att->participant?->name));
            $sheet->setCellValue('C' . $row, $att->utusan_name_snapshot ?? ($att->participant?->utusan?->name));
            $sheet->setCellValue('D' . $row, $att->jabatan_name_snapshot ?? ($att->participant?->jabatan?->name));
            $sheet->setCellValue('E' . $row, $att->mwcnu_name_snapshot ?? ($att->participant?->mwcnu?->name));
            $sheet->setCellValue('F' . $row, $att->type->value);
            $sheet->setCellValue('G' . $row, $att->station_name_snapshot ?? ($att->station?->name));
            $row++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $fileName = 'Laporan_Absensi_PCNU_' . date('Ymd_His') . '.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');
        exit;
    }
}
