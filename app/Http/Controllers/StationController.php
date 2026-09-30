<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\StationToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StationController extends Controller
{
    public function index(Request $request)
    {
        $query = Station::with('tokens');

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%")
                  ->orWhere('mac_address', 'like', "%{$request->search}%");
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $stations = $query->latest()->paginate(10)->withQueryString();

        return view('stations.index', compact('stations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'type' => ['required', 'string', 'in:IN,OUT,BOTH'],
            'status' => ['required', 'string', 'in:ACTIVE,INACTIVE,MAINTENANCE'],
            'mac_address' => ['nullable', 'string', 'max:50', 'unique:stations,mac_address'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        $data['station_code'] = 'STN-' . strtoupper(Str::random(6));

        $station = Station::create($data);

        // Generate token otomatis untuk station baru
        $plainToken = Str::random(40);
        StationToken::create([
            'station_id' => $station->id,
            'token_hash' => hash('sha256', $plainToken),
            'plain_token' => $plainToken,
            'name' => 'Default Token',
            'expires_at' => null,
        ]);

        return back()->with('success', 'Station berhasil ditambahkan.');
    }

    public function update(Request $request, Station $station)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'type' => ['required', 'string', 'in:IN,OUT,BOTH'],
            'status' => ['required', 'string', 'in:ACTIVE,INACTIVE,MAINTENANCE'],
            'mac_address' => ['nullable', 'string', 'max:50', Rule::unique('stations')->ignore($station->id)],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        $station->update($data);
        return back()->with('success', 'Station berhasil diperbarui.');
    }

    public function destroy(Station $station)
    {
        $station->delete();
        return back()->with('success', 'Station berhasil dihapus.');
    }

    public function kiosk(Station $station)
    {
        return view('stations.kiosk', compact('station'));
    }
}
