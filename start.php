<?php

namespace Leadsbot;

require __DIR__ . '/./vendor/autoload.php';

use Leadsbot\Bot;

const TOKEN = "1844696370:AAE6l1RtoWWpSfdFi1luzKmpW3k-PaK-yG4";

$data = json_decode(file_get_contents('php://input'), true);

$chatID  = $data['message']['chat']['id'];
$message = $data['message']['text'];
$bot = new Bot(TOKEN);
$bot->saveLog($data);

$bot->doIt($message, $chatID);
