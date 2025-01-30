<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MazeScoreController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'moves' => 'required|integer',
            'difficulty' => 'required|integer',
        ]);

        Score::create([
            'username' => $request->username,
            'moves' => $request->moves,
            'difficulty' => $request->difficulty,
        ]);

        return response()->json(['message' => 'Score opgeslagen!'], 200);
    }
}
