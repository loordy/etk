<?php

namespace App\Repositories\v1;

use App\Models\v1\Vacancies;


/**
 * Class VacancyRepository
 * @package App\Repositories
 * @version November 2, 2018, 5:10 am UTC
 *
*/
class VacanciesRepository extends BaseApiv1Repository
{
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
        return Vacancies::class;
    }


    /**
     * @param array $attributes
     * @param $id
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        $model = $this->model->findOrFail($id);
        $model->fill($attributes);
        $model->save();
        $this->resetModel();



        return $model;
    }


    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|mixed
     * @throws \Throwable
     */
    public function create(array $attributes)
    {
        $model = $this->model->fill($attributes);
        $model->saveOrFail();
        $this->resetModel();


        return $model;
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        $model = $this->model->find($id, $columns);
        $this->resetModel();

        return $model;
    }


    /**
     * @param $id
     * @return int
     */
    public function delete($id)
    {

        $model = $this->model->find($id);
        $this->resetModel();
        if ($model) {
            $deleted = $model->delete();
            return $deleted;
        }

    }
}
