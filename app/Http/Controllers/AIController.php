<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AI\ChatGPT;

class AIController extends Controller
{
    public function __construct(private ChatGPT $chatGPT)
    {
    }
    public function test(Request $request)
    {
        $prompt = $request->input('prompt');
        return $this->chatGPT->chat($prompt);
    }
}
