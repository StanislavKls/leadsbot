<?php

namespace Leadsbot;

require __DIR__ . '/./vendor/autoload.php';

use Leadsbot\Bot;

$params = include(__DIR__ . '/./config.php');
$data = json_decode(file_get_contents('php://input'), true);

$chatID  = $data['message']['chat']['id'];
$message = $data['message']['text'];
$bot = new Bot($params['telegram']);
$bot->saveLog($data);
$bot->doIt($message, $chatID);
