<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects  = Project::with('kategori')->latest()->paginate(10);
        $kategoris = Kategori::orderBy('kategori_name')->get();
    
        return view('projects.index', compact('projects','kategoris'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        
        return view('projects.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'deskripsi'    => 'required|string',
            'id_kategori'  => 'required|exists:kategoris,id_kategori',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $filename = time().'_'.Str::slug($request->project_name).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('images/projects', $filename, 'public');
        }

        Project::create([
            'project_name' => $request->project_name,
            'deskripsi'    => $request->deskripsi,
            'foto'         => $path,
            'id_kategori'  => $request->id_kategori,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project berhasil dibuat!');
    }

    public function edit(Project $project)
    {
        $kategoris = Kategori::all();
        return view('projects.edit', compact('project', 'kategoris'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'deskripsi'    => 'required|string',
            'id_kategori'  => 'required|exists:kategoris,id_kategori',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if($request->hasFile('foto')){
            if($project->foto && file_exists(public_path('storage/'.$project->foto))){
                unlink(public_path('storage/'.$project->foto));
            }
            $file = $request->file('foto');
            $filename = time().'_'.Str::slug($request->project_name).'.'.$file->getClientOriginalExtension();
            $project->foto = $file->storeAs('images/projects', $filename, 'public');
        }

        $project->project_name = $request->project_name;
        $project->deskripsi    = $request->deskripsi;
        $project->id_kategori  = $request->id_kategori;
        $project->save();

        return redirect()->route('projects.index')->with('success', 'Project berhasil diperbarui!');
    }

    public function destroy(Project $project)
    {
        if ($project->foto && Storage::disk('public')->exists($project->foto)) {
            Storage::disk('public')->delete($project->foto);
        }
    
        $project->delete();
    
        return redirect()->route('projects.index')->with('success', 'Project berhasil dihapus!');
    }
}
