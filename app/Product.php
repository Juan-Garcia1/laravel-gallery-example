<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description',  'image'];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
