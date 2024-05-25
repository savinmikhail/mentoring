<?php

namespace App\Contracts\Compiler;

interface CodeCompilerInterface
{
    public function compileCode(string $code, int $lessonId, string $action): array;
}