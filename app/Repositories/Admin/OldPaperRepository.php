<?php

namespace App\Repositories\Admin;

use App\Model\OldPaper;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class OldPaperRepository
 * @package App\Repositories\Admin
 * @version October 26, 2020, 6:27 pm UTC
 */
class OldPaperRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'paper_category_id',
        'name',
        'creator_name',
        'paper_pdf',
        'language',
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
        return OldPaper::class;
    }

    public function store($input)
    {
        try {
            DB::beginTransaction();

            if (! empty($input['paper_pdf'])) {
                $old_img = '';
                if (! empty($input->paper_pdf)) {
                    $old_img = $input->paper_pdf;
                }
                $input['paper_pdf'] = fileUpload($input['paper_pdf'], path_paper_pdf(), $old_img);
            }
            $book = $this->create($input);

            return $book;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function updateOldPaper($input, $id)
    {
        try {
            DB::beginTransaction();

            if (! empty($input['paper_pdf'])) {
                $old_img = '';
                if (! empty($input->paper_pdf)) {
                    $old_img = $input->paper_pdf;
                }
                $input['paper_pdf'] = fileUpload($input['paper_pdf'], path_paper_pdf(), $old_img);
            }
            $book = $this->update($input, $id);

            return $book;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
