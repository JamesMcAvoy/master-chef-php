<?php

namespace Resto\Model;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model {

    protected $table = 'ingredients';

    protected $primaryKey = 'ingredient_id';

    protected $fillable = array(
        'name',
        'stock',
        'preservation'
    );

    public $timestamps = false;

    public function lists() {
        return $this->hasMany('Resto\List', 'ingredient_id');
    }

}
