<?php

namespace Resto\Model;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model {

    protected $table = 'recipes';

    protected $primaryKey = 'recipe_id';

    protected $fillable = array(
        'description',
        'preparation_time',
        'cooking_time',
        'sleeping_time',
        'type',
        'stock'
    );

    public $timestamps = false;

    public function lists() {
        return $this->hasMany('Resto\List', 'recipe_id');
    }

}

