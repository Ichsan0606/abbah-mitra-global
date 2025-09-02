<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = About::all();
        return view('abouts.index', compact('abouts'));
    }

    public function create()
    {
        return view('abouts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        About::create($request->all());
        return redirect()->route('abouts.index')->with('success', 'About created successfully.');
    }

    public function edit(About $about)
    {
        return view('abouts.edit', compact('about'));
    }

    public function update(Request $request, About $about)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $about->update($request->all());
        return redirect()->route('abouts.index')->with('success', 'About updated successfully.');
    }

    public function destroy(About $about)
    {
        $about->delete();
        return redirect()->route('abouts.index')->with('success', 'About deleted successfully.');
    }
}
