<?php

namespace App\Model\Admin;

use App\Model\BookCategory;
use Eloquent as Model;

/**
 * Class Book
 * @package App\Model\Admin
 * @version October 26, 2020, 3:50 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $books
 * @property string $name
 * @property string $seller_name
 * @property string $book_pdf
 * @property string $language
 * @property integer $book_category_id
 */
class Book extends Model
{

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'             => 'required|unique:books',
        'seller_name'      => 'required',
        'book_pdf'         => 'required|mimes:pdf|max:10000',
        'language'         => 'required',
        'book_category_id' => 'required',
    ];
    public $table = 'books';
    public $fillable = [
        'name',
        'seller_name',
        'book_pdf',
        'language',
        'book_category_id',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'               => 'integer',
        'name'             => 'string',
        'seller_name'      => 'string',
        'book_pdf'         => 'string',
        'language'         => 'string',
        'book_category_id' => 'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function category()
    {
        return $this->belongsTo(BookCategory::class, 'book_category_id');
    }
}
