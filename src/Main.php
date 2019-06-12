<?php

namespace Resto;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Main implements MessageComponentInterface {
    protected $client = false;

    public function __construct() {
        $this->client = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->client->attach($conn);

        echo "Client connected\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {

        echo sprintf('Client %d sending message "%s"' . "\n"
            , $from->resourceId
            , $msg);

        //$client->send($msg);
    }

    public function onClose(ConnectionInterface $conn) {
        $this->client->detach($conn);
        $this->client = false;

        echo "Client has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
