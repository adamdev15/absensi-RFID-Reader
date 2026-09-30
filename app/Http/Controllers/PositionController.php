<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PositionController extends Controller
{
    public function index(Request $request)
    {
        $query = Position::query();
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        $positions = $query->latest()->paginate(10)->withQueryString();
        
        return view('master.positions.index', compact('positions'));
    }

    public function create()
    {
        return view('master.positions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:positions,name'],
            'status' => ['required', 'string', 'in:ACTIVE,INACTIVE'],
        ]);

        Position::create($data);
        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function edit(Position $position)
    {
        return view('master.positions.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('positions')->ignore($position->id)],
            'status' => ['required', 'string', 'in:ACTIVE,INACTIVE'],
        ]);

        $position->update($data);
        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy(Position $position)
    {
        if ($position->participants()->exists()) {
            return back()->with('error', 'Gagal menghapus! Jabatan ini sedang digunakan oleh ' . $position->participants()->count() . ' peserta.');
        }

        $position->delete();
        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil dihapus.');
    }
}
