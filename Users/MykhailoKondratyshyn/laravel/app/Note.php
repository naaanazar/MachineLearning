<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{

    protected $fillable = ['title', 'body'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
