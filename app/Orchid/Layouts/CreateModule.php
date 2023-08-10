<?php

namespace App\Orchid\Layouts;

use App\Models\User;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class CreateModule extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('id')->type('hidden'),
            Group::make([
                Input::make('title')->required()->title('Название модуля'),
                Input::make('description')->required()->title('Описание модуля'),
            ]),

        ];
    }
}

