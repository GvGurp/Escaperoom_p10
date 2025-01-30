<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MazeScore extends Model
{
    use HasFactory;

    protected $fillable = ['username', 'moves', 'difficulty'];
}