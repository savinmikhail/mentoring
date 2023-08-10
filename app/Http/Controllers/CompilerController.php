<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Tests\Unit\Lesson1Test;
use Tests\Unit\Lesson2Test;
use Tests\Unit\Lesson3Test;
use Tests\Unit\Lesson4Test;

class CompilerController extends Controller
{
   public function compile(Request $request)
   {
       $code = $request->all();
       $code = $code['code'];
       $filePath = "/var/www/html/storage/logs/code.php";
       $outputFilePath = "/var/www/html/storage/logs/output.txt"; // Path to the output file
       file_put_contents($filePath, $code);

//       $dockerCommand = "docker run --rm -v $executionPath:$executionPath php:latest php $userCodeFile";
//       $commandOutput = shell_exec($dockerCommand);

       $command = "/usr/local/bin/php $filePath > $outputFilePath 2>&1";

       shell_exec($command);
       $shellResponse = file_get_contents($outputFilePath);
       // Execute tests
       $testClassName = "Tests\Unit\Lesson" . $request->id . "Test"; // This will be "Lesson1Test"
       $testClass = new $testClassName('');
       $testResult = $testClass->testUserProvidedFunction();

       $responseData = [
           'shell' => $shellResponse,
           'tests' => $testResult
       ];
       return response()->json($responseData);
    }
    public function showLesson($id)
    {
        $lesson = Lesson::find($id);

        return view('lesson', [
            'lesson' => $lesson,
        ]);
    }

}
