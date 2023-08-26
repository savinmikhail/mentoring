<?php

namespace App\Orchid\Layouts;

use App\Models\Lesson;
use App\Models\Module;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ModuleListTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'module';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', 'Название')->render(function (Module $module) {
                return '<a href="' . route('platform.lesson.show', ['module' => $module->id]) . '">' . $module->title . '</a>';
            }),
            TD::make('description', 'Описание'),
            TD::make('')->render(function (Module $module){
                return ModalToggle::make('Редактировать')
                    ->modal('updateModule')
                    ->method('updateModule')
                    ->modalTitle('Редактирование модуля' .' '. $module->title)
                    ->asyncParameters([
                        'module' => $module->id
                    ]);
            }),
            TD::make('')->render(function (Module $module) {
                return Button::make('Удалить')
                    ->confirm('Вы уверены, что хотите удалить модуль?')
                    ->method('removeModule')
                    ->parameters(['module_id' => $module->id])
                    ->icon('trash');
            }),
        ];
    }
}
