<?php

require './vendor/autoload.php';

use React\EventLoop\Factory;
use React\Socket\Server;
use React\Socket\ConnectionInterface;
use Resto\Message;
use Resto\Database;
use Resto\Model\Recipe;

$loop = Factory::create();
$socket = new Server('127.0.0.1:8080', $loop);
$client = false;

Database::setDatabase();

$socket->on('connection', function (ConnectionInterface $connection) use($client) {
    //On connection
    if(!$client) {
        $client = true;
        echo 'Client connected' . "\n";
    }

    //On message
    $connection->on('data', function ($data)  {
        echo 'New message: ' . $data . "\n";
        $message = json_decode($data, true);

        switch($message) {
            //Init
            case (isset($message['type']) && $message['type'] == 'bonjour'):
                $recipes = Recipe::all();
                break;
        }
    });

    //On disconnection
    $connection->on('close', function () {
        $client = false;
        echo 'Client has disconnected' . "\n";
    });
});

$loop->run();
