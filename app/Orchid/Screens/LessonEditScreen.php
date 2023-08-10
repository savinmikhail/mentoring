<?php

namespace App\Orchid\Screens;

use App\Http\Requests\LessonRequest;
use App\Models\Lesson;
use App\Models\Module;
use App\Orchid\Layouts\LessonEditTable;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class LessonEditScreen extends Screen
{
    public $module;

    public $lesson;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Module $module): iterable
    {
        $this->module = $module;
        $this->lesson = Lesson::where('module_id', $this->module->id)->get();
        return [
            'lesson' => $this->lesson
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Уроки модуля - ' . $this->module->title;
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Добавление урока')->modal('addLesson', )->method('addLesson'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            LessonEditTable::class,
            Layout::modal('addLesson', Layout::rows([
                Input::make('module_id' )->type('hidden')->value($this->module->id),
                Input::make('title')->title('Название'),
                Input::make('text')->title('Текст'),
                Input::make('image')->title('Изображение'),
                Input::make('code')->title('Начальный код'),
            ]))->title('Добавление урока'),
        ];
    }

    public function addLesson(LessonRequest $request)
    {
        $validatedData = $request->validated();
        Lesson::create($validatedData);
        Alert::info('Урок добавлен');
    }

    public function removeLesson(int $lesson_id)
    {
        $lesson = Lesson::find($lesson_id);
        $lesson->delete();
        Alert::info('Урок успешно удален');
    }
}
