<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Conversations</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Liste des Conversations</h1>

    <!-- Formulaire pour créer une nouvelle conversation -->
    <form action="{{ route('conversations.store') }}" method="POST">
        @csrf
        <input type="text" name="label" placeholder="Intitulé de la conversation (optionnel)">
        <button type="submit">Créer une nouvelle conversation</button>
    </form>

    <h2>Conversations existantes</h2>

    <!-- Liste des conversations existantes -->
    <ul>
        @foreach ($conversations as $conversation)
            <li>
                <a href="{{ route('conversations.show', $conversation->id) }}">
                    Conversation #{{ $conversation->id }} - {{ $conversation->label ?? 'Sans titre' }}
                </a>
            </li>
        @endforeach
    </ul>
</body>
</html>
