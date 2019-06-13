<?php

namespace Resto;

use Resto\Model\Recipe;
use Resto\Model\Ingredient;

class Cook /*extends \Thread*/ {

    private $id;
    private $order;

    public function __construct($id, $order) {
        $this->id = $id;
        $this->order = $order;
    }

    public function run() {
        $recipe = Recipe::where('description', 'like', '%' . $this->order . '%')->first();
        $time = $recipe->preparation_time + $recipe->cooking_time + $recipe->sleeping_time;

        echo "Preparation {$recipe->description}, sleep {$time}\n";
        usleep($time);
    }

}
