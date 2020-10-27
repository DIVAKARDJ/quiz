<?php

namespace App\Repositories;

use App\Model\Post;

/**
 * Class PostRepository
 * @package App\Repositories
 * @version October 27, 2020, 3:43 am UTC
 */
class PostRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
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
        return Post::class;
    }
}
