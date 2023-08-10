<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

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
