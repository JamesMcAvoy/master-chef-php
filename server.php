<?php

require './vendor/autoload.php';

use React\EventLoop\Factory;
use React\Socket\Server;
use React\Socket\ConnectionInterface;

$loop = Factory::create();
$socket = new Server('127.0.0.1:80', $loop);
$client = false;

$socket->on('connection', function (ConnectionInterface $connection) use($client) {
    if(!$client) {
        $client = true;
        echo 'Client connected' . "\n";
    }

    /*$connection->write("Hello " . $connection->getRemoteAddress() . "!\n");
    $connection->write("Welcome to this amazing server!\n");
    $connection->write("Here's a tip: don't say anything.\n");

    $connection->on('data', function ($data) use ($connection) {
        $connection->close();
    });*/

    $connection->on('close', function () {
        $client = false;
        echo 'Client has disconnected' . "\n";
    });
});

$loop->run();
