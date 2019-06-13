<?php

namespace Resto;

use React\Socket\ConnectionInterface;

class Kitchen {

    public function prepare($order, ConnectionInterface $connection) {
        foreach($order['commande']['entrees'] as $entree) {
            $cook = new Cook($order['id'], $entree);
            $cook->run();
            $cook = false;
            $connection->write(json_encode(["type"=>"commande", "id"=>$order['id'], "commande"=>$entree]));
        }
        foreach($order['commande']['plats'] as $plat) {
            $cook = new Cook($order['id'], $plat);
            $cook->run();
            $cook = false;
            $connection->write(json_encode(["type"=>"commande", "id"=>$order['id'], "commande"=>$plat]));
        }
        foreach($order['commande']['desserts'] as $dessert) {
            $cook = new Cook($order['id'], $dessert);
            $cook->run();
            $cook = false;
            $connection->write(json_encode(["type"=>"commande", "id"=>$order['id'], "commande"=>$dessert]));
        }
    }

}
