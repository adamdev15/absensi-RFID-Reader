<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Participant;
use App\Models\RfidCard;
use App\Models\Station;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPeserta = Participant::count();
        $rfidTerdaftar = RfidCard::whereNotNull('participant_id')->count();
        $totalStation = Station::count();
        
        // Asumsikan station online jika last_seen_at tidak lebih dari 5 menit yang lalu
        $stationOnline = Station::where('last_seen_at', '>=', now()->subMinutes(5))->count();
        
        $absensiHariIni = Attendance::whereDate('attendance_at', now()->toDateString())->count();

        // Mengambil 5 absensi terbaru hari ini
        $recentAttendances = Attendance::with(['participant.utusan', 'participant.mwcnu', 'station'])
            ->whereDate('attendance_at', now()->toDateString())
            ->latest('attendance_at')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalPeserta',
            'rfidTerdaftar',
            'totalStation',
            'stationOnline',
            'absensiHariIni',
            'recentAttendances'
        ));
    }
}
