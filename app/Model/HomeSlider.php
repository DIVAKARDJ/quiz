<?php

namespace App\Model;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HomeSlider
 * @package App\Model
 * @version October 28, 2020, 5:14 pm UTC
 *
 * @property string $image
 */
class HomeSlider extends Model
{
    use SoftDeletes;

    public $table = 'home_sliders';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'image',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'    => 'integer',
        'image' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
