<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

use Illuminate\Support\Str;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::latest()->paginate(10);
        
        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'job'       => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $filename = time().'_'.Str::slug($request->full_name).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('images/teams', $filename, 'public');
        }

        Team::create([
            'full_name' => $request->full_name,
            'job'       => $request->job,
            'deskripsi' => $request->deskripsi,
            'foto'      => $path,
        ]);

        return redirect()->route('teams.index')->with('success', 'Team berhasil ditambahkan!');
    }

    public function edit(Team $team)
    {
        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'job'       => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if($request->hasFile('foto')){
            // hapus foto lama jika ada
            if($team->foto && file_exists(public_path('storage/'.$team->foto))){
                unlink(public_path('storage/'.$team->foto));
            }

            $file = $request->file('foto');
            $filename = time().'_'.Str::slug($request->full_name).'.'.$file->getClientOriginalExtension();
            $team->foto = $file->storeAs('images/teams', $filename, 'public');
        }

        $team->full_name = $request->full_name;
        $team->job       = $request->job;
        $team->deskripsi = $request->deskripsi;
        $team->save();

        return redirect()->route('teams.index')->with('success', 'Team berhasil diperbarui!');
    }

    public function destroy(Team $team)
    {
        if($team->foto && file_exists(public_path('storage/'.$team->foto))){
            unlink(public_path('storage/'.$team->foto));
        }
        $team->delete();

        return redirect()->route('teams.index')->with('success', 'Team berhasil dihapus!');
    }
}
