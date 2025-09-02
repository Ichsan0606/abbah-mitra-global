<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->paginate(10);
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $filename = time().'_'.Str::slug($request->client_name).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('images/clients', $filename, 'public');
        }

        Client::create([
            'client_name' => $request->client_name,
            'deskripsi'   => $request->deskripsi,
            'foto'        => $path,
        ]);

        return redirect()->route('clients.index')->with('success', 'Client berhasil dibuat!');
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if($request->hasFile('foto')){
            // hapus foto lama
            if($client->foto && file_exists(public_path('storage/'.$client->foto))){
                unlink(public_path('storage/'.$client->foto));
            }

            $file = $request->file('foto');
            $filename = time().'_'.Str::slug($request->client_name).'.'.$file->getClientOriginalExtension();
            $client->foto = $file->storeAs('images/clients', $filename, 'public');
        }

        $client->client_name = $request->client_name;
        $client->deskripsi   = $request->deskripsi;
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client berhasil diperbarui!');
    }

    public function destroy(Client $client)
    {
        if ($client->foto && Storage::disk('public')->exists($client->foto)) {
            Storage::disk('public')->delete($client->foto);
        }
    
        $client->delete();
    
        return redirect()->route('clients.index')->with('success', 'Client berhasil dihapus!');
    }
}
