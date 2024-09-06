<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Message;
use App\Models\Conversation;

class ChatController extends Controller
{
    


    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
            'conversation_id' => 'required|exists:conversations,id',
        ]);

        $conversation = Conversation::findOrFail($request->conversation_id);

        Message::create([
            'conversation_id' => $conversation->id,
            'role' => 'user',
            'content' => $request->message,
        ]);


        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('openai.api_key'),
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',  // Le modèle utilisé, tu peux utiliser un autre modèle si besoin
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $request->message
                ],
            ],
            'max_tokens' => 150, // Limiter la réponse pour éviter trop de contenu
        ]);
    
        $gptResponse = $response->json()['choices'][0]['message']['content'];
    
        Message::create([
            'conversation_id' => $conversation->id,
            'role' => 'gpt',
            'content' => $gptResponse,
        ]);

        return redirect()->route('conversations.show', ['id' => $conversation->id]);
    }
}
