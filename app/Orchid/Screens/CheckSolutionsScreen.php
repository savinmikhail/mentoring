<?php

namespace App\Orchid\Screens;

use App\Models\Lesson;
use App\Models\UserSolution;
use App\Orchid\Layouts\CheckSolutionsTable;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Code;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class CheckSolutionsScreen extends Screen
{

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */

    public function query($lessonId): iterable
    {
        return [
            'userSolution' => UserSolution::query()->where('lesson_id', $lessonId)->get()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Решения пользователей';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            CheckSolutionsTable::class,
            Layout::modal('review1', Layout::rows(
                [
                    Input::make('id')->type('hidden'),
                    Input::make('user_id')->type('hidden'),
                    Input::make('lesson_id')->type('hidden'),

                    Code::make('solution')->title('Решение')->height('600px'),
                    Select::make('passed')->title('Пройдено')->options(
                        [
                            true   => 'Пройдено',
                            false => 'Не пройдено',
                        ]
                    ),
                ]
            ))->async('asyncReview'),
            Layout::modal('review2', Layout::rows(
                [
                    Input::make('id')->type('hidden'),
                    Input::make('user_id')->type('hidden'),
                    Input::make('lesson_id')->type('hidden'),

                    Code::make('solution')->title('Решение')->height('600px'),

                ]
            ))->async('asyncReview'),
        ];
    }

    public function asyncReview(UserSolution $userSolution): array
    {
        return [
            'id' => $userSolution->id,
            'lesson_id' => $userSolution->lesson_id,
            'user_id' => $userSolution->user_id,
            'solution' => $userSolution->solution,
        ];
    }

    public function review(Request $request)
    {
        $userSolution = UserSolution::query()->find($request->input('id'));
        $userSolution->reviewed = true;
        $userSolution->update($request->all());
        Toast::info('Сохранено');
    }
}
