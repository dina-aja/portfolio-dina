<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Form kesan & pesan dari pengunjung.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:150',
            'subject' => 'nullable|max:150',
            'message' => 'required|min:5',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'message.required' => 'Pesan wajib diisi.',
            'message.min' => 'Pesan minimal 5 karakter.',
        ]);

        Message::create($validated);

        return back()->with('success', 'Terima kasih! Kesan dan pesan kamu sudah terkirim.');
    }

    public function index()
    {
        return view('admin.messages.index', [
            'messages' => Message::latest()->get(),
        ]);
    }

    public function show(Message $message)
    {
        $message->update(['is_read' => true]);

        return view('admin.messages.show', compact('message'));
    }

    public function markRead(Message $message)
    {
        $message->update(['is_read' => true]);

        return back()->with('success', 'Pesan ditandai sudah dibaca.');
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()
            ->route('messages.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}
