<?php

namespace App\Orchid\Screens;

use App\Http\Requests\LessonRequest;
use App\Http\Requests\LessonTestRequest;
use App\Models\Lesson;
use App\Models\LessonTest;
use App\Models\Module;
use App\Orchid\Layouts\LessonEditTable;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Code;
use Orchid\Screen\Fields\SimpleMDE;
use Orchid\Screen\Layouts\Modal;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

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
        $lesson = Lesson::query()->where('module_id', $this->module->id)->get();

        $this->lesson = $lesson;
        return [
            'lesson' => Lesson::all()
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
                SimpleMDE::make('text')->title('Текст'),
                Code::make('code')->title('Начальный код')->height('150px')->language('clike'),
            ]))->title('Добавление урока')->size(Modal::SIZE_LG),

            Layout::modal('editLesson', Layout::rows(
                [
                    Input::make('id' )->type('hidden'),
                    Input::make('module_id' )->type('hidden'),

                    Input::make('title')->title('Название'),
                    SimpleMDE::make('text')->title('text'),
                    Code::make('code')->title('code'),
                ]
            ))->async('asyncGetLesson'),

            Layout::modal('addTests', Layout::rows(
                [
                    Input::make('id' )->type('hidden'),
                    Input::make('lesson_id' )->type('hidden'),

                    Input::make('input')->title('Input'),
                    Input::make('output')->title('Output'),
                ]
            ))->async('asyncAddTests'),
        ];
    }

    public function asyncAddTests(Lesson $lesson, LessonTest $lessonTest, Module $module): array
    {
        $this->module = $module;
        return [
            'id' =>  $lessonTest->id,
            'lesson_id' => $lesson->id,
            'input' => $lessonTest->input,
            'output' => $lessonTest->output,
        ];
    }

    public function addTests(Request $request)
    {
        $lessonTest = LessonTest::find($request->input('id'));
        if($lessonTest){
            $lessonTest->update($request->all());
            Toast::info('Тест успешно изменен');
        } else {
            Toast::info('Ошибка');
        }
    }
    public function asyncGetLesson(Lesson $lesson, Module $module): array
    {
        $this->module = $module;
        return [
            'id' =>  $lesson->id,
            'title' => $lesson->title,
            'text' => $lesson->text,
            'code' => $lesson->code,
            'module_id' => $lesson->module_id,
        ];
    }

    public function addLesson(LessonRequest $request)
    {
        $validatedData = $request->validated();
        Lesson::create($validatedData);
        Alert::info('Урок добавлен');
    }

    public function addLessonTest(LessonTestRequest $request, int $lesson_id)
    {
        $validatedData = $request->validated();
        LessonTest::create(array_merge($validatedData, ['lesson_id' => $lesson_id]));
    }

    public function updateLesson(LessonRequest $request)
    {
        $lesson = Lesson::find($request->input('id'))->update($request->validated());
        is_null($lesson) ?  Toast::info('Урок успешно создан') : Toast::info('Урок успешно изменен');
    }

    public function removeLesson(int $lesson_id)
    {
        $lesson = Lesson::find($lesson_id);
        $lesson->delete();
        Alert::info('Урок успешно удален');
    }
}
