<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Module::create([
            'title' => 'Арифметика',
            'description' => 'Современные программы создаются для обслуживания бизнесов, помощи в ежедневной жизни и развлечений. Но в основе их работы по-прежнему лежат вычисления. Наиболее простая и базовая тема в программировании — арифметика. В этом модуле мы переведем арифметические действия на язык программирования, поговорим о приоритете операций. Расскажем, что такое линтер и почему он может «ругаться».
'
        ]);
    }
}
