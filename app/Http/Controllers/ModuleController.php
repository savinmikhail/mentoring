<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::with('lessons')->get();

        return view('module', [
            'modules' => $modules
        ]);
    }
}
