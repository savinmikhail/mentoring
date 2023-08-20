<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\LessonTest;
class LessonsTest extends TestCase
{
    public function testUserProvidedFunction($lessonId)
    {
        $filePath = "/var/www/html/storage/logs/code.php";
        $outputFilePath = "/var/www/html/storage/logs/output.txt";
        $lessonTests = LessonTest::find($lessonId)->all();
        $flag = false;

        foreach ($lessonTests as $lessonTest) {
            // Construct the shell command with proper input and output
            $command = "/usr/local/bin/php {$filePath} > {$outputFilePath} 2>&1";

            // Pass input to the command and capture the output
            $input = escapeshellarg($lessonTest->input);  // Ensure proper escaping
            shell_exec("echo {$input} | {$command}");

            // Read the captured output from the file
            $fileShellResponse = file_get_contents($outputFilePath);

            if (trim($fileShellResponse) === trim($lessonTest->output)) {
                $flag = true;
            } else {
                $flag = false;
            }
        }
        return $flag;
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