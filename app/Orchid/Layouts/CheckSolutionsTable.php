<?php

namespace App\Orchid\Layouts;

use App\Models\Lesson;
use App\Models\User;
use App\Models\UserSolution;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CheckSolutionsTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'userSolution';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name' , 'Пользователь')->render(function (UserSolution $userSolution){
               return (User::query()->where('id', $userSolution->user_id)->first())->name;
            }),
            TD::make('solution' , 'Решение')->width(400),
            TD::make('attempts' , 'К-во попыток'),
            TD::make('passed', 'Пройдено')->render(function (UserSolution $userSolution) {
                if ($userSolution->passed === true) {
                    return 'Пройдено';
                } elseif ($userSolution->passed === false) {
                    return 'Не пройдено';
                }
            }),
            TD::make('Review')->render(function (UserSolution $userSolution){
                $lesson = Lesson::find($userSolution->lesson_id);
                if($lesson->manual_test){
                    return ModalToggle::make('Оставить комментарий')
                        ->modal('review1')
                        ->method('review')
                        ->modalTitle('Ревью')
                        ->asyncParameters([
                            'userSolution' => $userSolution->id,
                        ]);
                }else{
                    return ModalToggle::make('Оставить комментарий')
                        ->modal('review2')
                        ->method('review')
                        ->modalTitle('Ревью')
                        ->asyncParameters([
                            'userSolution' => $userSolution->id,
                        ]);
                }

            }),

        ];
    }
}
