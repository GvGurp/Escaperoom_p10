@extends('layout.main_layout') <!-- Je maakt gebruik van een hoofdlayout -->

@section('content')

    <!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gebruikerslijst</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto my-10 p-5 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4">Gebruikerslijst</h1>

    <!-- Controleer of er gebruikers zijn -->
    @if($users->isEmpty())
        <p class="text-gray-500">Er zijn geen gebruikers gevonden.</p>
    @else
        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
            <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 text-left text-sm text-gray-700">Voornaam</th>
                <th class="py-2 px-4 text-left text-sm text-gray-700">Achternaam</th>
                <th class="py-2 px-4 text-left text-sm text-gray-700">Gebruikersnaam</th>
                <th class="py-2 px-4 text-left text-sm text-gray-700">Email</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr class="border-b border-gray-200">
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $user->firstname }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $user->lastname }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $user->username }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $user->email }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>

</body>
</html>

@endsection
