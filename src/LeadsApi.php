<?php

namespace Leadsbot;

class LeadsApi
{
    private $url = 'http://api.leads.su/webmaster/geo/getCountries?token=51606a3c349510628e02632a8eeceb08';
    private $client;
    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client(['base_uri' => $this->url]);
    }
    public function getCountries()
    {
        $response = $this->client->request('GET', '');
        $data = json_decode($response->getBody()->getContents(), true);
        return $data['data'];
    }
}
