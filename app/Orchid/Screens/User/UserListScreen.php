<?php

declare(strict_types=1);

namespace App\Orchid\Screens\User;

use App\Orchid\Layouts\User\UserEditLayout;
use App\Orchid\Layouts\User\UserFiltersLayout;
use App\Orchid\Layouts\User\UserListLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Input;

class UserListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'users' => User::with('roles')
                ->filters(UserFiltersLayout::class)
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Пользователи';
    }

    /**
     * Display header description.
     */


    public function permission(): ?iterable
    {
        return [
            'platform.systems.users',
        ];
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Добавить'))
                ->icon('bs.plus-circle')
                ->route('platform.systems.users.create'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            UserFiltersLayout::class,
            UserListLayout::class,

            Layout::modal('asyncEditUserModal', UserEditLayout::class)
                ->async('asyncGetUser'),
            Layout::modal('editRole', Layout::rows(
                [
                    Select::make('role', ) ->options([
                        'STUDENT'   => 'Студент',
                        'ADMIN' => 'Админ',
                        'USER' => 'User',
                    ])->title('Роль')
                ]
            ))->async('asyncGetUser'),
        ];
    }

    /**
     * @return array
     */
    public function asyncGetUser(User $user): iterable
    {
        return [
            'user' => $user,
        ];
    }

    public function updateRole(Request $request, User $user)
    {
        $dto = $request->validate([
            'role' => [
                'required',
                'string'
            ]]);
        $user->role = $dto['role'];
        $user->save();
        Toast::info(__('Роль изменена.'));
    }

    public function saveUser(Request $request, User $user): void
    {
        $request->validate([
            'user.email' => [
                'required',
                Rule::unique(User::class, 'email')->ignore($user),
            ],
        ]);

        $user->fill($request->input('user'))->save();

        Toast::info(__('User was saved.'));
    }

    public function remove(Request $request): void
    {
        User::findOrFail($request->get('id'))->delete();

        Toast::info(__('User was removed'));
    }
}
