<?php

namespace Resto;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database {

    public static function setDatabase() {

        $content = parse_ini_file(__DIR__ . '/../database.ini');
        $capsule = new Capsule;

        $capsule->addConnection([
           "driver" => $content['driver'],
           "host" => $content['host'],
           "port" => $content['port'],
           "database" => $content['database'],
           "username" => $content['username'],
           "password" => $content['password']
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        $capsule->bootEloquent();

    }

}
