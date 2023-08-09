<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    public function testUserProvidedFunction()
    {

        require_once ("/var/www/html/storage/logs/code.php");
        $result = differ(2012, 2015);
        return $result === 3;
    }
}
