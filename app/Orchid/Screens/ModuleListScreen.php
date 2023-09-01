<?php

namespace App\Orchid\Screens;

use App\Http\Requests\ModuleRequest;
use App\Models\Module;
use App\Orchid\Layouts\CreateModule;
use App\Orchid\Layouts\ModuleListTable;
use App\Orchid\Layouts\UpdateModule;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class ModuleListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'module' => Module::all()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Модули';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Создать модуль')->modal('createModule')->method('createModule')->icon('bs.plus-circle')
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
            Layout::modal('editModule', UpdateModule::class)->async('asyncGetModule'),
            Layout::modal('createModule', CreateModule::class)->title('Создание модуля')->applyButton('Принять'),
            ModuleListTable::class,

        ];
    }


    public function asyncGetModule(int $id ,$title, $description): array
    {

        return [
            'moduleId' => $id,
            'title' => $title,
            'description' => $description,
        ];
    }


    public function createModule(ModuleRequest $request)
    {

        $module = $request->validationData();
        Module::create($module);
    }

    public function updateModule( ModuleRequest $request)
    {
        $data = $request->validated();

        $module = Module::query()->find($data['id']);

        $module->update($data);
    }

    public function removeModule(int $module_id)
    {
        $module = Module::find($module_id);
        $module->delete();
        Alert::info('Модуль успешно удален');
    }
}
