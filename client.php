<?php

/**
 * Client testing
 */

use React\EventLoop\Factory;
use React\Socket\Connector;
use React\Socket\ConnectionInterface;

require './vendor/autoload.php';

$loop = Factory::create();
$connector = new Connector($loop);

$connector->connect('127.0.0.1:8080')->then(function (ConnectionInterface $connection) {
    $connection->write('{"type":"commande","id": 12,"commande":{"entrees":["Salades de pates au thon"],"plats":["Burger saumon"],"desserts":["Gateau fondant au chocolat"]}}');

    $connection->on('data', function ($data) {
        echo $data;
    });
    $connection->on('close', function () {
        echo '[CLOSED]' . PHP_EOL;
    });
}, 'printf');
$loop->run();
