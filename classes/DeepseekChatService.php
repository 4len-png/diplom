<?php

namespace services;

class DeepseekChatService
{
    private $apiKey;
    private $apiUrl = 'https://api.deepseek.com/chat/completions';
    private $chatHistory = []; // Массив для хранения истории сообщений

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Добавляет сообщение в историю чата.
     *
     * @param string $role Роль отправителя (system, user, assistant).
     * @param string $content Текст сообщения.
     */
    public function addMessage($role, $content)
    {
        $this->chatHistory[] = [
            'role' => $role,
            'content' => $content,
        ];
    }

    /**
     * Очищает историю чата.
     */
    public function clearHistory()
    {
        $this->chatHistory = [];
    }


    public function sendChat($model = 'deepseek-chat', $stream = false)
    {
        $data = [
            'model' => $model,
            'messages' => $this->chatHistory,
            'stream' => $stream,
        ];

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apiKey,
        ];

        return $this->sendCurlRequest($this->apiUrl, $headers, $data);
    }


    private function sendCurlRequest($url, $headers = [], $data = [], $method = 'POST')
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_TIMEOUT, 600);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 600);

        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        do {
            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                throw new Exception('Curl error: ' . curl_error($ch));
            }
        } while (trim($response) === '');

        curl_close($ch);
        return json_decode($response, true);
    }


    public function sendMessage($messages, $model = 'deepseek-chat', $stream = false)
    {
        $data = [
            'model' => $model,
            'messages' => $messages,
            'stream' => $stream,
        ];

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apiKey,
        ];

        return $this->sendCurlRequest($this->apiUrl, $headers, $data);
    }
    public function sendMessageStream($messages, $model = 'deepseek-chat')
    {
        $data = [
            'model' => $model,
            'messages' => $messages,
            'stream' => true,
        ];

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apiKey,
        ];

        $ch = curl_init($this->apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_WRITEFUNCTION, function ($ch, $chunk) {
            echo $chunk;
            flush();
            return strlen($chunk);
        });

        ob_implicit_flush(true);
        curl_exec($ch);
        curl_close($ch);
    }
}
