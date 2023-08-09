<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function testTask1()
    {
        // Define test cases
        $testCases = [
            [[2023, 2025], 2],
            [[2000, 2010], 10],
            [[1990, 2020], 30],
        ];

        // Run the test cases
        foreach ($testCases as $testCase) {
            $isCodeCorrect = $this->task1($testCase[0], $testCase[1]);
            if (!$isCodeCorrect){
                return response()->json([
                    'success' => false,
                    'Expect output' => $testCase[1],
                    'Get output' => $testCase[0]
                ]);
            }
        }
    }

    function task1($input, $expectedOutput) {
        list($year1, $year2) = $input;
        $result = differ($year1, $year2);
        return $result === $expectedOutput;
    }
}
