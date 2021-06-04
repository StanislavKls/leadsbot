<?php

namespace Leadsbot;

use Illuminate\Support\Arr;
use Leadsbot\LeadsApi;

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
    public function doIt($command, $id, $arg = []): bool
    {
        $commands = [
            '/getCountries' => '$this->getCountries()',
        ];
        if (array_key_exists($command, $commands)) {
            return call_user_func_array($commands[$command], $arg);
        } else {
            $this->sendMessage($id, 'Нет такой команды');
            return false;
        }
    }
    private function getCountries($token)
    {
        $api = new LeadsApi($token);
        
    }
}
