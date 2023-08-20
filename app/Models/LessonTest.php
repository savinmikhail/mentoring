<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'input', 'output', 'lesson_id'
        ];

}
