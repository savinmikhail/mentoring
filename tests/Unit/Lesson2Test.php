<?php
namespace Tests\Unit;
use PHPUnit\Framework\TestCase;

class Lesson2Test extends TestCase
{
    public function testUserProvidedFunction()
    {
        $outputFilePath = "/var/www/html/storage/logs/output.txt"; // Path to the output file

        // Read the contents of the file into a variable
        $output = file_get_contents($outputFilePath);

        return $output === "Hello World" ? true : false;
    }
}