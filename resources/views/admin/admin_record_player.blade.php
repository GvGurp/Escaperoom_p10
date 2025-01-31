@extends('layout.main_layout')

@section('content')
    <div class="flex items-center justify-center py-10">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-5xl">
            <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Gebruikerslijst</h2>

            <!-- Controleer of er gebruikers zijn -->
            @if($users->isEmpty())
                <p class="text-center text-gray-500">Er zijn geen gebruikers gevonden.</p>
            @else
                <div class="overflow-x-auto bg-white rounded-lg shadow-md">
                    <table class="min-w-full table-auto border-collapse rounded-lg">
                        <thead class="bg-slate-800 text-white">
                        <tr>
                            <th class="py-3 px-4 text-left text-sm font-medium">Voornaam</th>
                            <th class="py-3 px-4 text-left text-sm font-medium">Achternaam</th>
                            <th class="py-3 px-4 text-left text-sm font-medium">Gebruikersnaam</th>
                            <th class="py-3 px-4 text-left text-sm font-medium">Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors duration-200">
                                <td class="py-3 px-4 text-sm text-gray-700">{{ $user->firstname }}</td>
                                <td class="py-3 px-4 text-sm text-gray-700">{{ $user->lastname }}</td>
                                <td class="py-3 px-4 text-sm text-gray-700">{{ $user->username }}</td>
                                <td class="py-3 px-4 text-sm text-gray-700">{{ $user->email }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
