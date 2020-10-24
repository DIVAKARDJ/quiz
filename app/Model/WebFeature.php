<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WebFeature extends Model
{
    protected $fillable = ['title', 'description', 'image', 'status'];

    public function getImageAttribute($photo){
        $p = asset('assets/images/feature.png');
        if(!empty($photo)) {
            $p =  asset(path_image().$photo);
        }
        return $p;
    }
}
