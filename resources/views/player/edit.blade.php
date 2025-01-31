@extends('layout.main_layout')

@section('content')
    <div class="container mx-auto mt-10 p-6 bg-gray-800 text-white rounded-lg shadow-lg max-w-2xl"> <!-- Main Card -->
        <h1 class="text-3xl font-bold mb-6 text-center">Profiel Bewerken</h1>

        <!-- Succesbericht (Gaby) -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form id="editProfileForm" method="POST" action="{{ route('user.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Naamveld  (Gaby)-->
            <div class="flex flex-col">
                <label for="firstname" class="text-sm font-medium mb-2">Voornaam:</label>
                <input type="text" id="firstname" name="firstname" value="{{ $user->firstname }}"
                       class="bg-gray-700 text-white rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <!-- Achternaamveld (Gaby)-->
            <div class="flex flex-col">
                <label for="lastname" class="text-sm font-medium mb-2">Achternaam:</label>
                <input type="text" id="lastname" name="lastname" value="{{ $user->lastname }}"
                       class="bg-gray-700 text-white rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <!-- Telefoonnummer  (Gaby) -->
            <div class="flex flex-col">
                <label for="phonenumber" class="text-sm font-medium mb-2">Telefoonnummer:</label>
                <input type="text" id="phonenumber" name="phonenumber" value="{{ $user->phonenumber }}"
                       class="bg-gray-700 text-white rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <!-- Email  (Gaby) -->
            <div class="flex flex-col">
                <label for="email" class="text-sm font-medium mb-2">Email:</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}"
                       class="bg-gray-700 text-white rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <!-- Bevestigingsmelding (Gaby)-->
            <div id="confirmationMessage" class="bg-yellow-500 text-black p-4 rounded hidden">
                Weet je zeker dat je jouw profiel wilt wijzigen? Klik dan op Bevestigen!
            </div>

            <!-- Bevestigingsknoppen (Gaby) -->
            <div class="flex justify-between items-center">
                <button type="button" onclick="showConfirmation()"
                        class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Toon Bevestiging
                </button>
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
                    Bevestigen
                </button>
            </div>
        </form>
    </div>

    <script>
        // Bevestigingsmelding tonen (Gaby)
        function showConfirmation() {
            document.getElementById('confirmationMessage').classList.remove('hidden');
        }
    </script>
@endsection
