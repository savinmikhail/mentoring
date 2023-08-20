<?php

namespace App\Http\Controllers;

use App\Contracts\Compiler\CodeCompilerInterface;
use App\Models\Lesson;
use Illuminate\Http\Request;

class CompilerController extends Controller
{
    protected $codeCompiler;

    public function __construct(CodeCompilerInterface $codeCompiler)
    {
        $this->codeCompiler = $codeCompiler;
    }

    public function compile(Request $request)
    {
        $code = $request->input('code');
        $lessonId = $request->input('id');
        $action = $request->input('action'); // Get the action parameter


        $result = $this->codeCompiler->compileCode($code, $lessonId, $action);
        return response()->json($result);
    }

    public function showLesson($id)
    {
        $lesson = Lesson::find($id);

        return view('lesson', [
            'lesson' => $lesson,
        ]);
    }
}
