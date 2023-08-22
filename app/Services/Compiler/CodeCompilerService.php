<?php

namespace App\Services\Compiler;

use App\Contracts\Compiler\CodeCompilerInterface;
use App\Models\Lesson;
use App\Models\User;
use App\Models\UserSolution;
use Illuminate\Support\Facades\Auth;
use Tests\Unit\LessonsTest;
class CodeCompilerService implements CodeCompilerInterface
{
    public function compileCode(string $code, int $lessonId, string $action): array
    {
        $filePath = "/var/www/html/storage/logs/code.php";
        $outputFilePath = "/var/www/html/storage/logs/output.txt";

        file_put_contents($filePath, $code);

        $command = "/usr/local/bin/php $filePath > $outputFilePath 2>&1";
        shell_exec($command);

        $shellResponse = file_get_contents($outputFilePath);

        if ($action === "tests") {

            //save submit in bd
            $UserSolution = UserSolution::where('user_id', auth()->user()->id)->
                where('lesson_id', $lessonId)->first();
            if(empty($UserSolution)){
                $UserSolution = new UserSolution();
            }
            $UserSolution->attempts++;
            $UserSolution->save();

            // Выполнение тестов
            $LessonsTest = new LessonsTest('');
            $testResult = $LessonsTest->testUserProvidedFunction($lessonId);
            $testResult = $testResult ? 'Tests passed' : 'Tests failed';

        } elseif ($action === "code") {
            $testResult = '';
        } elseif ($action === "send"){
            $testResult = $this->storeUserSolution($lessonId, $code) ? 'Solution was saved' : 'Error occurred';
        }

        if($testResult) {
            $this->storeUserSolution($lessonId, $code);
        }

        $responseData = [
            'shell' => $shellResponse,
            'tests' => $testResult
        ];

        return $responseData;
    }
    public function storeUserSolution(int $lessonId, string $code)
    {
        $UserSolution = UserSolution::where('user_id', auth()->user()->id)->
            where('lesson_id', $lessonId)->first();
        if(!$UserSolution){
            $UserSolution = new UserSolution();
        }
        $UserSolution->lesson_id = $lessonId;
        $UserSolution->user_id = auth()->user()->id;
        $UserSolution->solution = $code;
        return  $UserSolution->save();
    }
}