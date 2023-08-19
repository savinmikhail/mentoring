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
        try {
            $code = $request->input('code');
            $lessonId = $request->input('id');

            $result = $this->codeCompiler->compileCode($code, $lessonId);

            return response()->json($result);

        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return response()->json(['error' => $errorMessage], 500);
        }
    }

    public function showLesson($id)
    {
        $lesson = Lesson::find($id);

        return view('lesson', [
            'lesson' => $lesson,
        ]);
    }
}
