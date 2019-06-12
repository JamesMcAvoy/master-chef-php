<?php

use Illuminate\Database\Eloquent\Model

class List extends Model {

    protected $table = 'list';

    protected $fillable = array(
        'number'
    );

    public $timestamps = false;

    public ingredients() {
        return $this->belongsToMany('Resto\Model\Ingredient', 'ingredient_id');
    }

    public recipes() {
        return $this->belongsToMany('Resto\Recipe', 'recipe_id');
    }

}
