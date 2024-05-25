<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class UserSolution extends Model
{
    use HasFactory;
    use AsSource;
    use Chartable;
    protected $fillable = [
        'user_id', 'lesson_id', 'solution', 'attempts', 'passed', 'reviewed'
    ];

}
