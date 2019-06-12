<?php

namespace Resto\Model;

use Illuminate\Database\Eloquent\Model;

class List extends Model {

    protected $table = 'list';

    protected $fillable = array(
        'number'
    );

    public $timestamps = false;

    public function ingredients() {
        return $this->belongsToMany('Resto\Model\Ingredient', 'ingredient_id');
    }

    public function recipes() {
        return $this->belongsToMany('Resto\Recipe', 'recipe_id');
    }

}
