<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    public function saveScore(Request $request)
    {
        $request->validate([
            'score' => 'required|integer',
            'time' => 'required|string',
            'level_id' => 'required|integer',
        ]);

        $userId = Auth::id();

        try {
            $score = new Score();
            $score->user_id = $userId;
            $score->level_id = $request->input('level_id');
            $score->points = $request->input('score');
            $score->save();

            return response()->json(['success' => true, 'message' => 'Score saved successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}


