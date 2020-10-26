<?php

namespace App\Model;

use App\Model\Admin\Book;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    protected $fillable = ['name', 'image', 'status'];

    public function books()
    {
        return $this->hasMany(Book::class, 'book_category_id');
    }

}
