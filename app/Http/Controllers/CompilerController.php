<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tests\Unit\UserTest;

class CompilerController extends Controller
{
   public function compile(Request $request)
   {
       $code = $request->all();
       $code = $code['code'];

       $filePath = "/var/www/html/storage/logs/code.php";
       file_put_contents($filePath, $code);

//       // Execute user's code within a Docker container
//       $dockerCommand = "docker run --rm -v $executionPath:$executionPath php:latest php $userCodeFile";
//       $commandOutput = shell_exec($dockerCommand);
       // Execute tests
       $postAddTest = new UserTest('UserTest');
       $testResult = $postAddTest->testUserProvidedFunction();

       $output = shell_exec("/usr/local/bin/php $filePath 2>&1");
       $responseData = [
           'shell' => $output,
           'tests' => $testResult,
       ];
       return response()->json($responseData);

   }

}
//<?
//list($year1, $year2) = [2013, 2015];
//function differ($year1, $year2)
//{
//    return abs($year1 - $year2);
//}
//
//var_dump(differ($year1, $year2));
