<?php

namespace App\Model;

use Eloquent as Model;

/**
 * Class Post
 * @package App\Model
 * @version October 27, 2020, 3:43 am UTC
 *
 * @property string $name
 */
class Post extends Model
{

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];
    public $table = 'posts';
    public $fillable = [
        'name',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'id'   => 'integer',
    ];


}
