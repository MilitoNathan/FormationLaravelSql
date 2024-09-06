<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversation #{{ $conversation->id }}</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <h1>Conversation #{{ $conversation->id }} - {{ $conversation->label ?? 'Sans titre' }}</h1>

    <!-- Affichage des messages de la conversation -->
    @if ($messages->isEmpty())
        <p>Aucun message dans cette conversation.</p>
    @else
        <ul>
            @foreach ($messages as $message)

            @if ($message->role == 'user')
                <li class='msguser'>
                    <strong>{{ ucfirst($message->role) }}:</strong> {{ $message->content }}
                </li>
            @else
                <li class='msggpt'>
                    <strong>{{ ucfirst($message->role) }}:</strong> {{ $message->content }}
                </li>
            @endif
                
            @endforeach
        </ul>
    @endif

    <!-- Formulaire pour envoyer un nouveau message dans la conversation -->
    <form action="{{ route('send.message') }}" method="POST">
        @csrf
        <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
        <input type="text" name="message" placeholder="Votre message..." required>
        <button type="submit">Envoyer</button>
    </form>

    <a href="{{ route('conversations.index') }}">Retour à la liste des conversations</a>
</body>
</html>
