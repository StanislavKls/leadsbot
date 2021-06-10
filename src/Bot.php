<?php

namespace Leadsbot;

use Leadsbot\LeadsApi;

class Bot
{
    private $url;
    private $client;
    private $commands = [
        '/getCountries' => 'getCountries',
        '/getUser'      => 'getUser',
        '/start'        => 'start'
    ];

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
        file_put_contents('log.txt', print_r($data, true), FILE_APPEND);
        return true;
    }
    public function doIt($command, $id, $arg = []): bool
    {

        if (array_key_exists($command, $this->commands)) {
            $exec = $this->commands[$command];
            return $this->sendMessage($id, $this->$exec());
        } else {
            $this->sendMessage($id, 'Нет такой команды');
            return false;
        }
    }
    private function getCountries()
    {
        $api = new LeadsApi();
        return $api->getCountries();
    }
    private function getUser()
    {
        $api = new LeadsApi();
        return $api->getUser();
    }
    private function start()
    {
        return "Вывод списка стран: /getCountries\nВывод данных пользователя: /getUser";
    }
}
