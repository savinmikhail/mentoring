<?php

namespace App\Services\AI;
use Orhanerday\OpenAi\OpenAi;

class ChatGPT
{


public function chat($prompt)
{
    $open_ai = new OpenAi(env('OPEN_AI_KEY'));

    $complete = $open_ai->completion([
        'model' => 'text-davinci-003',
        'prompt' => ' '. $prompt,
        'temperature' => 0.9,
        'max_tokens' => 150,
        'frequency_penalty' => 0,
        'presence_penalty' => 0.6,
    ]);

    $response = json_decode($complete, true);
    return $response;
}


}
