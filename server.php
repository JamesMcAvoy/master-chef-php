<?php

require './vendor/autoload.php';

use React\EventLoop\Factory;
use React\Socket\Server;
use React\Socket\ConnectionInterface;
use Resto\Message;
use Resto\Database;

$loop = Factory::create();
$socket = new Server('127.0.0.1:8080', $loop);
$client = false;

Database::setDatabase();

$socket->on('connection', function (ConnectionInterface $connection) use($client) {
    if(!$client) {
        $client = true;
        echo 'Client connected' . "\n";
    }

    /**
     * Data control
     */
    $connection->on('data', function ($data)  {
        echo $data . "\n";
        Message::handle($data);
    });

    $connection->on('close', function () {
        $client = false;
        echo 'Client has disconnected' . "\n";
    });
});

$loop->run();
