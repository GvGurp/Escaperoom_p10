<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MazeController extends Controller
{
    public function index()
    {
        return view('level3_maze');
    }
}