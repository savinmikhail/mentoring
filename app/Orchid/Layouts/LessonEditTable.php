<?php

namespace App\Orchid\Layouts;

use App\Models\Lesson;
use App\Models\Module;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
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
            TD::make('text', 'Контент')->render(function (Lesson $lesson){
                $text = $lesson->text;
                return substr($text, 0, 50). '...';
            }),
            TD::make('code', 'Начальный код'),
            TD::make('Удалить')->render(function (Lesson $lesson) {
                return Button::make('Удалить')
                    ->confirm('Вы уверены, что хотите удалить урок?')
                    ->method('removeLesson')
                    ->parameters(['lesson_id' => $lesson->id])
                    ->icon('trash');
            }),
            TD::make('Редактировать')->render(function (Lesson $lesson){
                $module = Module::query()->find($lesson->module_id);
                return ModalToggle::make('Редактировать')
                    ->modal('editLesson')
                    ->method('updateLesson')
                    ->modalTitle('Редактирование ' .' '. $lesson->title)
                    ->asyncParameters([
                        'lesson' => $lesson->id,
                        'module' => $module->id
                    ]);
            }),
        ];
    }
}
