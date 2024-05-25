<?php

namespace App\Http\Controllers;

use App\Contracts\Compiler\CodeCompilerInterface;
use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Parsedown;

class CompilerController extends Controller
{
    protected $codeCompiler;

    public function __construct(CodeCompilerInterface $codeCompiler)
    {
        $this->codeCompiler = $codeCompiler;
    }

    private function updateLastSeen()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->last_seen = Carbon::now()->format('Y-m-d H:i');
            $user->save();
        }
    }
    public function compile(Request $request)
    {
        $this->updateLastSeen();
        
        $code = $request->input('code');
        $lessonId = $request->input('id');
        $action = $request->input('action'); // Get the action parameter


        $result = $this->codeCompiler->compileCode($code, $lessonId, $action);
        return response()->json($result);
    }

    public function showLesson($id)
    {
        $lesson = Lesson::find($id);

        $parseDown = new Parsedown();

        $lesson->text = $parseDown->text($lesson->text);
        return view('lesson', [
            'lesson' => $lesson,
        ]);
    }
}
