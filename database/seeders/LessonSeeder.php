<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lesson::create([
            'title' => 'Кавычки',
            'text' => "",
            'image' => 'cat',
            'code' => '[[PHP_CODE]] echo "King in the North!";',
            'module_id' => 1,

        ]);
    }
}
