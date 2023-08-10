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
            'text' => "PHP: Кавычки
Что такое строка
Зачем нужны двойные кавычки
В этом уроке мы разберем, что такое строки, зачем для них нужны одинарные и двойные кавычки. Также узнаем, что такое экранирующие последовательности и конкатенация.

Что такое строка
Любой одиночный символ в кавычках — это строка. Например:

'Hello'
'Goodbye'
'G'
' '
''
Пустая строка '' — это тоже строка. То есть строкой мы считаем все, что находится внутри кавычек, даже если это пробел, один символ или вообще отсутствие символов.

Ранее в уроках мы записывали строки в одинарных кавычках, но можно использовать и двойные:
<?php

Разберем, почему у обозначения строки есть два способа.

Зачем нужны двойные кавычки
Представим, что нам нужно напечатать строчку dragon's mother. Апостроф перед буквой s — это такой же символ, как одинарная кавычка. Попробуем:

<?php

print_r('Dragon's mother');
// PHP Parse error: syntax error, unexpected 's' (T_STRING), expecting ',' or ')'
Такая программа не будет работать. С точки зрения PHP строчка началась с",
            'image' => 'cat',
            'code' => '[[PHP_CODE]] echo "King in the North!";',
            'module_id' => 2,

        ]);
    }
}
