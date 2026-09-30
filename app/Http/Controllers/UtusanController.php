<?php

namespace App\Http\Controllers;

use App\Models\Utusan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UtusanController extends Controller
{
    public function index(Request $request)
    {
        $query = Utusan::query();
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        $utusanList = $query->latest()->paginate(10)->withQueryString();
        
        return view('master.utusan.index', compact('utusanList'));
    }

    public function create()
    {
        return view('master.utusan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:utusan,name'],
            'status' => ['required', 'string', 'in:ACTIVE,INACTIVE'],
        ]);

        Utusan::create($data);
        return redirect()->route('utusan.index')->with('success', 'Utusan berhasil ditambahkan.');
    }

    public function edit(Utusan $utusan)
    {
        return view('master.utusan.edit', compact('utusan'));
    }

    public function update(Request $request, Utusan $utusan)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('utusan')->ignore($utusan->id)],
            'status' => ['required', 'string', 'in:ACTIVE,INACTIVE'],
        ]);

        $utusan->update($data);
        return redirect()->route('utusan.index')->with('success', 'Utusan berhasil diperbarui.');
    }

    public function destroy(Utusan $utusan)
    {
        // Pastikan tidak dihapus jika ada peserta terkait (prevent if used)
        if ($utusan->participants()->exists()) {
            return back()->with('error', 'Gagal menghapus! Utusan ini sedang digunakan oleh ' . $utusan->participants()->count() . ' peserta.');
        }

        $utusan->delete();
        return redirect()->route('utusan.index')->with('success', 'Utusan berhasil dihapus.');
    }
}
