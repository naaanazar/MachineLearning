<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'body', 'description'];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
