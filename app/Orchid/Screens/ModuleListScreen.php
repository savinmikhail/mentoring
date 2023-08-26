<?php

namespace App\Orchid\Screens;

use App\Http\Requests\ModuleRequest;
use App\Models\Module;
use App\Orchid\Layouts\CreateModule;
use App\Orchid\Layouts\ModuleListTable;
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
            ModuleListTable::class,
            Layout::modal('createModule', CreateModule::class)->title('Создание модуля')->applyButton('Принять'),
            Layout::modal('updateModule', CreateModule::class)->async('asyncGetModule')
        ];
    }

    public function asyncGetModule(Module $module): array
    {
        return [
            '$module' => $module,
        ];
    }

    public function createModule(ModuleRequest $request)
    {

        $module = $request->validationData();
        Module::create($module);
    }

    public function updateModule(Module $module, ModuleRequest $request)
    {
        $data = $request->validated();

        $module->update($data);
    }

    public function removeModule(int $module_id)
    {
        $module = Module::find($module_id);
        $module->delete();
        Alert::info('Модуль успешно удален');
    }
}
