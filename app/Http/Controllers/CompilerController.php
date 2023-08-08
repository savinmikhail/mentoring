<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompilerController extends Controller
{
   public function compile(Request $request)
   {
       $code = $request->all()['code'];

       $filePath ="/var/www/html/storage/logs/code.php";
       file_put_contents($filePath, $code);

       $output = shell_exec("/usr/local/bin/php $filePath 2>&1");

       echo $output;

//       return view('welcome', [
//           'output' => 'sadasddasd',
//       ]);
   }
}
