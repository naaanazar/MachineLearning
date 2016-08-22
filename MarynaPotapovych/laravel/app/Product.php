<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['title', 'description', 'img'];


    protected $dates = ['deleted_at'];
    
    public function getImgAttribute($path)
    {
        $rozetka = strpos($path, 'rozetka.ua');
        
        if($rozetka) {
            return $path;
        } else {
            return '/images/'.$path;
        }
    }
}
