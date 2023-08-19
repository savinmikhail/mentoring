<?php

namespace App\Services\Compiler;

use App\Contracts\Compiler\CodeCompilerInterface;

class CodeCompilerService implements CodeCompilerInterface
{
    public function compileCode(string $code, int $lessonId): array
    {
        $filePath = "/var/www/html/storage/logs/code.php";
        $outputFilePath = "/var/www/html/storage/logs/output.txt";

        file_put_contents($filePath, $code);

        $command = "/usr/local/bin/php $filePath > $outputFilePath 2>&1";
        shell_exec($command);

        $shellResponse = file_get_contents($outputFilePath);

        // Выполнение тестов
        $testClassName = "Tests\Unit\Lesson" . $lessonId . "Test"; // Формируем имя класса теста
        $testClass = new $testClassName('');

        // Предполагая, что у тестов есть метод testUserProvidedFunction(),
        // который возвращает результат выполнения тестов
        $testResult = $testClass->testUserProvidedFunction();

        $responseData = [
            'shell' => $shellResponse,
            'tests' => $testResult
        ];

        return $responseData;
    }
}