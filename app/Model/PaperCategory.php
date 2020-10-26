<?php

namespace App\Model;

use Eloquent as Model;

/**
 * Class PaperCategory
 * @package App\Model\Admin
 * @version October 26, 2020, 5:29 pm UTC
 *
 * @property string $name
 * @property string $image
 * @property boolean $status
 */
class PaperCategory extends Model
{

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'   => 'required|unique:paper_categories',
        'image'  => 'mimes:jpeg,jpg,JPG,png,PNG,gif|max:5000',
        'status' => 'required',
    ];
    public $table = 'paper_categories';
    public $fillable = [
        'name',
        'image',
        'status',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'     => 'integer',
        'name'   => 'string',
        'image'  => 'string',
        'status' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function oldPapers()
    {
        return $this->hasMany(OldPaper::class, 'paper_category_id');
    }
}
