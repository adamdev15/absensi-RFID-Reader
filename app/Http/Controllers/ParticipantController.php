<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParticipantRequest;
use App\Models\Mwcnu;
use App\Models\Participant;
use App\Models\Position;
use App\Models\Utusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ParticipantController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:participants.view')->only(['index', 'show']);
        // $this->middleware('permission:participants.create')->only(['create', 'store']);
        // $this->middleware('permission:participants.update')->only(['edit', 'update']);
        // $this->middleware('permission:participants.delete')->only('destroy');
    }

    public function index(Request $request)
    {
        $query = Participant::with(['utusan', 'jabatan', 'mwcnu', 'rfidCards']);

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('participant_code', 'like', "%{$search}%")
                  ->orWhere('organization', 'like', "%{$search}%");
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter Utusan
        if ($request->filled('utusan_id')) {
            $query->where('utusan_id', $request->utusan_id);
        }

        $participants = $query->latest()->paginate(15)->withQueryString();
        $utusanList = Utusan::where('status', 'ACTIVE')->orderBy('name')->get();

        return view('participants.index', compact('participants', 'utusanList'));
    }

    public function create()
    {
        $utusanList = Utusan::where('status', 'ACTIVE')->orderBy('name')->get();
        $positions = Position::where('status', 'ACTIVE')->orderBy('name')->get();
        $mwcnuList = Mwcnu::where('status', 'ACTIVE')->orderBy('name')->get();

        // Auto generate participant code (PST-YYYYMMDD-XXX)
        $date = now()->format('Ymd');
        $lastParticipant = Participant::where('participant_code', 'like', "PST-{$date}-%")->latest('id')->first();
        $sequence = $lastParticipant ? ((int) substr($lastParticipant->participant_code, -3)) + 1 : 1;
        $nextCode = "PST-{$date}-" . str_pad($sequence, 3, '0', STR_PAD_LEFT);

        return view('participants.create', compact('utusanList', 'positions', 'mwcnuList', 'nextCode'));
    }

    public function store(ParticipantRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $data = $request->validated();

            // Handle file uploads
            if ($request->hasFile('photo')) {
                $data['photo_path'] = $request->file('photo')->store('participants/photos', 'public');
            }

            if ($request->hasFile('mandate_letter')) {
                $data['mandate_letter_path'] = $request->file('mandate_letter')->store('participants/mandates', 'public');
            }

            Participant::create($data);

            DB::commit();
            return redirect()->route('participants.index')->with('success', 'Peserta berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menambahkan peserta: ' . $e->getMessage());
        }
    }

    public function show(Participant $participant)
    {
        $participant->load(['utusan', 'jabatan', 'mwcnu', 'rfidCards', 'attendances' => function($q) {
            $q->latest('attendance_at')->take(10);
        }]);
        
        return view('participants.show', compact('participant'));
    }

    public function edit(Participant $participant)
    {
        $utusanList = Utusan::where('status', 'ACTIVE')->orderBy('name')->get();
        $positions = Position::where('status', 'ACTIVE')->orderBy('name')->get();
        $mwcnuList = Mwcnu::where('status', 'ACTIVE')->orderBy('name')->get();

        return view('participants.edit', compact('participant', 'utusanList', 'positions', 'mwcnuList'));
    }

    public function update(ParticipantRequest $request, Participant $participant)
    {
        try {
            DB::beginTransaction();
            
            $data = $request->validated();

            // Handle file uploads
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($participant->photo_path && Storage::disk('public')->exists($participant->photo_path)) {
                    Storage::disk('public')->delete($participant->photo_path);
                }
                $data['photo_path'] = $request->file('photo')->store('participants/photos', 'public');
            }

            if ($request->hasFile('mandate_letter')) {
                // Delete old mandate if exists
                if ($participant->mandate_letter_path && Storage::disk('public')->exists($participant->mandate_letter_path)) {
                    Storage::disk('public')->delete($participant->mandate_letter_path);
                }
                $data['mandate_letter_path'] = $request->file('mandate_letter')->store('participants/mandates', 'public');
            }

            $participant->update($data);

            DB::commit();
            return redirect()->route('participants.index')->with('success', 'Data peserta berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui peserta: ' . $e->getMessage());
        }
    }

    public function destroy(Participant $participant)
    {
        try {
            DB::beginTransaction();
            
            // Unassign all RFID cards automatically handled by event/observer or explicitly here
            $participant->rfidCards()->update(['status' => 'UNASSIGNED', 'participant_id' => null, 'unregistered_at' => now()]);
            
            $participant->delete();
            
            DB::commit();
            return redirect()->route('participants.index')->with('success', 'Peserta berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus peserta: ' . $e->getMessage());
        }
    }
}
