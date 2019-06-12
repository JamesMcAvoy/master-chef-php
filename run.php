<?php

require './vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Resto\Main;

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Main()
            )
        ),
    80
);

$server->run();
