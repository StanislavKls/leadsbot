<?php

namespace Leadsbot;

class Bot
{
    private $url;
    private $client;

    public function __construct($token)
    {
        $this->url    = "https://api.telegram.org/bot{$token}/";
        $this->client = new \GuzzleHttp\Client(['base_uri' => $this->url]);
    }
    public function sendMessage($id, $text)
    {
        $params = ['chat_id' => $id,'text' => $text];
        $response = $this->client->request('GET', 'sendMessage', ['query' => $params]);
    }
    public function saveLog($data)
    {
        file_put_contents('log.txt', print_r($data, true));
    }
}
