<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About; // jangan lupa import model About
use App\Models\Project; // jangan lupa import model Project
use App\Models\Client; // jangan lupa import model Client
use App\Models\Team; // jangan lupa import model Client
use App\Models\Kategori; // jangan lupa import model Client
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class HomeController extends Controller
{
    public function index()
    {
        
        $abouts = About::first();
        
        $projects = Project::with('kategori')->get();

        $clients = Client::all();

        $teams = Team::all();

        $kategoris = Kategori::orderBy('kategori_name')->get();

        return view('home.index', compact('abouts', 'projects', 'clients','teams', 'kategoris'));
    }
    public function show($encryptedId)
    {
        try {
            $id = Crypt::decryptString($encryptedId);
            $team = Team::findOrFail($id);

            return view('team.show', compact('team'));
        } catch (DecryptException $e) {
            // kalau decrypt gagal, redirect ke home
            return redirect()->route('home')->with('error', 'Data tidak valid.');
        } catch (\Exception $e) {
            // kalau ID tidak ditemukan atau error lain
            return redirect()->route('home')->with('error', 'Team tidak ditemukan.');
        }
    }
}
