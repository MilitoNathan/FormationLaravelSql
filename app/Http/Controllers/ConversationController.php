<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;

class ConversationController extends Controller
{
    public function index()
    {
        $conversations = Conversation::all();

        return view('conversations.index', compact('conversations'));
    }

    public function store(Request $request)
    {
        Conversation::create([
            'label' => $request->input('label', 'Nouvelle conversation'),
        ]);

        return redirect()->route('conversations.index');
    }

    public function show($id)
    {
        $conversation = Conversation::findOrFail($id);

        $messages = $conversation->messages;

        return view('chat.show', compact('conversation', 'messages'));
    }
}
