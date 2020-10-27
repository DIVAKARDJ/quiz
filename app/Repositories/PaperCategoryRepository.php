<?php

namespace App\Repositories;

use App\Model\PaperCategory;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class PaperCategoryRepository
 * @package App\Repositories
 * @version October 26, 2020, 5:29 pm UTC
 */
class PaperCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'image',
        'status',
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
        return PaperCategory::class;
    }

    public function store($input)
    {
        try {
            DB::beginTransaction();

            if (! empty($input['image'])) {
                $old_img = '';
                if (! empty($input->image)) {
                    $old_img = $input->image;
                }
                $input['image'] = fileUpload($input['image'], path_category_image(), $old_img);
            }
            $paperCategory = $this->create($input);

            return $paperCategory;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function updatePaperCategory($input, $id)
    {
        try {
            DB::beginTransaction();

            if (! empty($input['image'])) {
                $old_img = '';
                if (! empty($input->image)) {
                    $old_img = $input->image;
                }
                $input['image'] = fileUpload($input['image'], path_category_image(), $old_img);
            }
            $paperCategory = $this->update($input, $id);

            return $paperCategory;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
