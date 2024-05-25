<?php

namespace App\Services\AI;
use Exception;
use Orhanerday\OpenAi\OpenAi;

class ChatGPT
{
    /**
     * @throws Exception
     */
    public function chat(string $prompt): array
{
    $open_ai = new OpenAi(env('OPEN_AI_KEY'));
    $open_ai->setBaseURL('https://api.proxyapi.ru/openai');

    $complete = $open_ai->chat([
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            [
                "role" => "system",
                "content" => "You are a helpful assistant."
            ],
            [
                "role" => "user",
                "content" => "Who won the world series in 2020?"
            ],
            [
                "role" => "assistant",
                "content" => "The Los Angeles Dodgers won the World Series in 2020."
            ],
            [
                "role" => "user",
                "content" => "Where was it played?"
            ],
        ],
        'temperature' => 1.0,
        'max_tokens' => 4000,
        'frequency_penalty' => 0,
        'presence_penalty' => 0,
    ]);

    $response = json_decode($complete, true);
    return $response;
}


}
