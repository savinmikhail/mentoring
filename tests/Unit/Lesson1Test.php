<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class Lesson1Test extends TestCase
{
    public function testUserProvidedFunction()
    {

        require_once ("/var/www/html/storage/logs/code.php");
        $result = differ(2012, 2015);
        return $result === 3;
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