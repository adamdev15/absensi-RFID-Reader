<?php

namespace App\Http\Controllers;

use App\Models\Mwcnu;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MwcnuController extends Controller
{
    public function index(Request $request)
    {
        $query = Mwcnu::query();
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        $mwcnuList = $query->latest()->paginate(10)->withQueryString();
        
        return view('master.mwcnu.index', compact('mwcnuList'));
    }

    public function create()
    {
        return view('master.mwcnu.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:mwcnu,name'],
            'status' => ['required', 'string', 'in:ACTIVE,INACTIVE'],
        ]);

        Mwcnu::create($data);
        return redirect()->route('mwcnu.index')->with('success', 'MWCNU berhasil ditambahkan.');
    }

    public function edit(Mwcnu $mwcnu)
    {
        return view('master.mwcnu.edit', compact('mwcnu'));
    }

    public function update(Request $request, Mwcnu $mwcnu)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('mwcnu')->ignore($mwcnu->id)],
            'status' => ['required', 'string', 'in:ACTIVE,INACTIVE'],
        ]);

        $mwcnu->update($data);
        return redirect()->route('mwcnu.index')->with('success', 'MWCNU berhasil diperbarui.');
    }

    public function destroy(Mwcnu $mwcnu)
    {
        if ($mwcnu->participants()->exists()) {
            return back()->with('error', 'Gagal menghapus! MWCNU ini sedang digunakan oleh ' . $mwcnu->participants()->count() . ' peserta.');
        }

        $mwcnu->delete();
        return redirect()->route('mwcnu.index')->with('success', 'MWCNU berhasil dihapus.');
    }
}
