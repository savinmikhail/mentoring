<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class Lesson1Test extends TestCase
{

    public function testUserProvidedFunction()
    {
        try {
            ob_start(); // Start output buffering
            require "/var/www/html/storage/logs/code.php"; // Include user code
            $result = differ(2012, 2015);

            if ($result === 3){
                $output = ob_get_clean(); // Get the buffered output
                return ['result' => true, 'output' => $output];
            }

        } catch (\Exception $e) {
            return ['result' => false, 'output' => $e->getMessage()];
        }
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