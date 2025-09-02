<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::latest()->paginate(10);
        return view('kategoris.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategoris.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_name' => 'required|string|max:255'
        ]);

        Kategori::create([
            'kategori_name' => $request->kategori_name
        ]);

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Kategori $kategori)
    {
        return view('kategoris.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'kategori_name' => 'required|string|max:255'
        ]);

        $kategori->update([
            'kategori_name' => $request->kategori_name
        ]);

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
