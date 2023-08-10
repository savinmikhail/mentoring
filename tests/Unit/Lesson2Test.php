<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class Lesson2Test extends TestCase
{
    public function testUserProvidedFunction()
    {
        require_once ("/var/www/html/storage/logs/code.php");
        $output = shell_exec("/usr/local/bin/php /var/www/html/storage/logs/code.php 2>&1");
        return $output === "Hello World" ? true : false;
    }
}
