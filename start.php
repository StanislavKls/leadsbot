<?php

namespace Leadsbot;

require __DIR__ . './vendor/autoload.php';

use Leadsbot\Bot;

$token = "1844696370:AAE6l1RtoWWpSfdFi1luzKmpW3k-PaK-yG4";

$bot = new Bot($token);

$bot->sendMessage(149019377, 'test');
