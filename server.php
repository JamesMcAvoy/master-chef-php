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
    $connection->on('data', function ($data) use($connection)  {
        echo 'New message: ' . $data . "\n";
        $message = json_decode($data, true);

        switch($message) {
            //Init
            case (isset($message['type']) && $message['type'] == 'bonjour'):
                $recipes = Recipe::all();
                foreach($recipes as $recipe) {
                    if($recipe->type == 'entree') $array['entrees'][] = $recipe->description;
                    elseif($recipe->type == 'dish') $array['plats'][] = $recipe->description;
                    elseif($recipe->type == 'dessert') $array['desserts'][] = $recipe->description;
                }
                $array['temps'] = 0;
                $array['acceleration'] = 60;
                $array['horaires'] = [[12, 15], [19, 22]];
                $array['carres'] = [[
                    '2'  => 5,
                    '4'  => 5,
                    '6'  => 3,
                    '8'  => 2,
                    '10' => 1
                ],[
                    '2'  => 5,
                    '4'  => 5,
                    '6'  => 2,
                    '8'  => 3,
                    '10' => 1
                ]];

                $connection->write(json_encode([
                    'sauvegarde' => false,
                    'restos' => [$array]
                ]));
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
