<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    // simpan pesan dari form contact
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string',
        ]);

        Message::create($request->all());

        return back()->with('success', 'Pesan Anda berhasil dikirim!');
    }

    // tampilkan semua pesan di admin
    public function index()
    {
        $messages = Message::latest()->paginate(10);

        return view('contact.index', compact('messages'));
    }

    // tampilkan detail pesan
    public function show($id)
    {
        $message = Message::findOrFail($id);
        
        return view('contact.show', compact('message'));
    }

    // hapus pesan
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->route('contact.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
