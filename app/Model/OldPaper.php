<?php

namespace App\Model;

use Eloquent as Model;

/**
 * Class OldPaper
 * @package App\Model\Admin
 * @version October 26, 2020, 6:27 pm UTC
 *
 * @property integer $paper_category_id
 * @property string $name
 * @property string $creator_name
 * @property string $paper_pdf
 * @property string $language
 */
class OldPaper extends Model
{

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'              => 'required|unique:paper_categories',
        'creator_name'      => 'required',
        'paper_pdf'         => 'required|mimes:pdf|max:10000',
        'language'          => 'required',
        'paper_category_id' => 'required',
    ];
    public $table = 'old_papers';
    public $fillable = [
        'paper_category_id',
        'name',
        'creator_name',
        'paper_pdf',
        'language',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                => 'integer',
        'paper_category_id' => 'integer',
        'name'              => 'string',
        'creator_name'      => 'string',
        'paper_pdf'         => 'string',
        'language'          => 'string',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function category()
    {
        return $this->belongsTo(PaperCategory::class, 'paper_category_id');
    }

}
