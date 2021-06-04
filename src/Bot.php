<?php

namespace Leadsbot;

class Bot
{
    private $token;
    private $url;
    private $client;

    public function __construct($token)
    {
        $this->token  = $token;
        $this->url    = "https://api.telegram.org/bot{$token}/";
        $this->client = new \GuzzleHttp\Client(['base_uri' => $this->url]);
    }
    public function sendMessage($id, $text)
    {
        $params = ['chat_id' => $id,'text' => $text];
        $response = $this->client->request('GET', 'sendMessage', ['query' => $params]);
    }
}
