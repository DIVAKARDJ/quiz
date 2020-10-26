<?php

namespace App\Repositories\Admin;

use App\Model\Admin\Book;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class BookRepository
 * @package App\Repositories\Admin
 * @version October 26, 2020, 3:50 pm UTC
 */
class BookRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'seller_name',
        'book_pdf',
        'language',
        'book_category_id',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Book::class;
    }

    public function store($input)
    {
        try {
            DB::beginTransaction();

            if (! empty($input['book_pdf'])) {
                $old_img = '';
                if (! empty($input->book_pdf)) {
                    $old_img = $input->book_pdf;
                }
                $input['book_pdf'] = fileUpload($input['book_pdf'], path_book_pdf(), $old_img);
            }
            $book = $this->create($input);

            return $book;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function updateBook($input, $id)
    {
        try {
            DB::beginTransaction();

            if (! empty($input['book_pdf'])) {
                $old_img = '';
                if (! empty($input->book_pdf)) {
                    $old_img = $input->book_pdf;
                }
                $input['book_pdf'] = fileUpload($input['book_pdf'], path_book_pdf(), $old_img);
            }
            $book = $this->update($input, $id);

            return $book;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
