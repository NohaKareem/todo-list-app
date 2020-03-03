<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoItem extends Model
{
    /**
     * mass-assignable properties
     */
    protected $fillable = [
        'item', 'done'
    ];
}
