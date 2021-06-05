<?php

namespace Leadsbot;

class LeadsApi
{
    private $url = 'http://api.leads.su/webmaster/';
    private $client;
    private $params;
    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client(['base_uri' => $this->url]);
        $this->params = include(__DIR__ . '/../config.php');
    }
    public function getCountries()
    {
        
        $response = $this->client->request('GET', 'geo/getCountries', ['query' => ['token' => $this->params['leads']]]);
        $data = json_decode($response->getBody()->getContents(), true);
        $country = array_map(fn($item) => $item['name'], $data['data']);
        usort($country, fn($a, $b) => $b <=> $a);
        return implode("\n", array_slice($country, 0, 10));
    }
    public function getUser()
    {
        $response = $this->client->request('GET', 'account', ['query' => ['token' => $this->params['leads']]]);
        $data = json_decode($response->getBody()->getContents(), true);
        return "ID = {$data['data']['id']}\nИмя = {$data['data']['name']}";
    }
}
