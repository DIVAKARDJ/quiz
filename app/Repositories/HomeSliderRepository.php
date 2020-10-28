<?php

namespace App\Repositories;

use App\Model\HomeSlider;

/**
 * Class HomeSliderRepository
 * @package App\Repositories
 * @version October 28, 2020, 5:14 pm UTC
 */
class HomeSliderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'image',
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
        return HomeSlider::class;
    }
}
