<?php

namespace Database\Seeders;

use App\Models\Utusan;
use App\Models\Position;
use App\Models\Mwcnu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Utusan (Kategori Utusan)
        $utusans = [
            'Pengurus Cabang',
            'Pengurus MWCNU',
            'Pengurus Ranting',
            'Badan Otonom (Banom)',
            'Lembaga PCNU',
            'Tamu Undangan',
        ];

        foreach ($utusans as $u) {
            Utusan::firstOrCreate(['name' => $u], [
                'code' => 'UT-' . strtoupper(Str::random(4)),
                'description' => 'Kategori utusan ' . $u,
                'status' => 'ACTIVE',
            ]);
        }

        // 2. Position (Jabatan)
        $positions = [
            'Rois Syuriyah',
            'Katib Syuriyah',
            'A\'wan',
            'Mustasyar',
            'Ketua Tanfidziyah',
            'Sekretaris',
            'Bendahara',
            'Ketua Lembaga/Banom',
            'Anggota',
        ];

        foreach ($positions as $p) {
            Position::firstOrCreate(['name' => $p], [
                'code' => 'JB-' . strtoupper(Str::random(4)),
                'description' => 'Jabatan ' . $p,
                'status' => 'ACTIVE',
            ]);
        }

        // 3. MWCNU (Majelis Wakil Cabang)
        $mwcnuList = [
            'Slawi',
            'Lebaksiu',
            'Balapulang',
            'Margasari',
            'Bumijawa',
            'Bojong',
            'Pagerbarang',
            'Dukuhwaru',
            'Adiwerna',
            'Talang',
            'Tarub',
            'Kramat',
            'Suradadi',
            'Warureja',
            'Kedungbanteng',
            'Pangkah',
            'Jatinegara',
            'Dukuhturi'
        ];

        foreach ($mwcnuList as $m) {
            Mwcnu::firstOrCreate(['name' => 'MWCNU ' . $m], [
                'code' => 'MWC-' . strtoupper(Str::random(5)),
                'description' => 'MWCNU Kecamatan ' . $m,
                'status' => 'ACTIVE',
            ]);
        }

        $this->command->info('✅ Master Data (Utusan, Jabatan, MWCNU) berhasil di-seed!');
    }
}
