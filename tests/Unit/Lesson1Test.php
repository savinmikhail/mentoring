<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class Lesson1Test extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testUserProvidedFunction()
    {

        require_once ("/var/www/html/storage/logs/code.php");
        $result = differ(2012, 2015);
        return $result === 3;
    }
}
