<?php

namespace App\Repositories\v1;

use App\Models\v1\Constants;
use Illuminate\Support\Facades\Cache;

class ConstantsRepository extends BaseApiv1Repository
{

    protected $cacheMinutes = 43200;


    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Constants::class;
    }

    /**
     * Get constants
     *
     * @return base constants
     */
    public function getConstants()
    {
        return Cache::tags(['constants'])->remember('constants',$this->getCacheMinutes(), function () {
            return $this->model->whereNotIn('id_const', [3, 4])->get();
        });
    }

    /**
     * Get soato
     *
     * @return soato
     */
    public function getSoato()
    {
        return Cache::tags(['constants'])->remember('soato',$this->getCacheMinutes(), function () {
            return $this->model->find(3)->value_const_ru;
        });
    }

    /**
     * Get kodp
     *
     * @return kodp
     */
    public function getKodp()
    {
        return Cache::tags(['constants'])->remember('kodp',$this->getCacheMinutes(), function () {
            return $this->model->find(4)->value_const_ru;
        });
    }

    public function update(array $attributes, $id)
    {

    }

    public function create(array $attributes)
    {

    }

    public function find($id, $columns = ['*'])
    {

    }


    public function delete($id)
    {

    }

}
