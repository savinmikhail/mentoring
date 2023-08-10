<?php

namespace App\Orchid\Layouts;

use App\Models\Lesson;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class LessonEditTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'lesson';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title' , 'Название'),
            TD::make('text', 'Текст'),
            TD::make('image', 'Изображение'),
            TD::make('code', 'Начальный код'),
            TD::make('')->render(function (Lesson $lesson) {
                return Button::make('Удалить')
                    ->confirm('Вы уверены, что хотите удалить урок?')
                    ->method('removeLesson')
                    ->parameters(['lesson_id' => $lesson->id])
                    ->icon('trash');
            }),

        ];
    }
}
