<?php

namespace App\Repositories\v1;

use App\Models\v1\Positions;
use App\Models\v1\Lc;

use App\Repositories\v1\StructuresRepository;
use App\Repositories\v1\VacanciesRepository;
use Illuminate\Support\Facades\Gate;
use App\Helpers\DateRange;
use App\Repositories\v1\LcRepository;

/**
 * Class PositionsRepository
 * @package App\Repositories
 * @version November 2, 2018, 5:11 am UTC
 *
 */
class PositionsRepository extends BaseApiv1Repository
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
        return Positions::class;
    }

    /**
     * @param array $attributes
     * @param $id
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        $model = $this->find($id);

        if ($model === 403) {
            return 403;
        }

        if (!$model->status_open_position && !empty($model->Contracts())) {
            return 424;
        }


        $model->fill($attributes);

        if ($model->isDirty('id_structure_position')) {

            $structures = $model->Structures()->first();

            if (empty($structures)) {
                return 404;
            }


            if (Gate::denies('create-position', $structures)) {
                $this->resetModel();
                return 403;
            };

            if (!DateRange::inRange($structures->date_start_structure, $structures->date_end_structure, $model->date_start_position, $model->date_end_position)) {
                return 424;
            }


        }


        // $structures = $model->Structures()->first();

//        $model->Vacancies()->orderBy('id_vacancy','desc')->first()->update([
//            'date_end_vacancy' => $model->date_start_position->subDay(1)
//        ]);
//
//        $vanancy = $model->Vacancies()->create([
//            'tin_company_vacancy' => $structures->tin_company_structure,
//            'region_vacancy' => $structures->region_structure,
//            'oked_vacancy' => $structures->oked_structure,
//            'name_company_vacancy' => $structures->name_structure,
//            'name_structure_vacancy' => $structures->name_structure,
//            'name_position_vacancy' => $model->name_position,
//            'code_prof_vacancy' => $model->code_prof_position,
//            'salary_vacancy' => $model->salary_position,
//            'request_vacancy' => $model->requirements_position,
//            'region4_vacancy' => $structures->region4_structure,
//            'date_end_vacancy' => $model->date_end_position,
//            'date_start_vacancy' => $model->date_start_position,
//            'id_position_vacancy' => $model->id_position,
//        ]);
        //$model->fill(['id_vacancy_position' => $vanancy->id_vacancy]);
        $model->save();
        $this->resetModel();

        //event(new RepositoryEntityUpdated(null,$model->tin_orgstruct,null,get_class($this->model)));

        return $model;
    }

    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function create(array $attributes)
    {
        $model = $this->model->fill($attributes);

        $structures = $model->Structures()->first();

        if (empty($structures)) {
            return 404;
        }

        if (Gate::denies('create-position', $structures)) {
            $this->resetModel();
            return 403;
        };

        if (!DateRange::inRange($structures->date_start_structure, $structures->date_end_structure, $model->date_start_position, $model->date_end_position)) {
            return 424;
        }
        $model->save();

//        $vanancy = $model->Vacancies()->create([
//            'tin_company_vacancy' => $structures->tin_company_structure,
//            'region_vacancy' => $structures->region_structure,
//            'oked_vacancy' => $structures->oked_structure,
//            'name_company_vacancy' => $structures->name_structure,
//            'name_structure_vacancy' => $structures->name_structure,
//            'name_position_vacancy' => $model->name_position,
//            'code_prof_vacancy' => $model->code_prof_position,
//            'salary_vacancy' => $model->salary_position,
//            'request_vacancy' => $model->requirements_position,
//            'region4_vacancy' => $structures->region4_structure,
//            'date_end_vacancy' => $model->date_end_position,
//            'date_start_vacancy' => $model->date_start_position,
//            'id_position_vacancy' => $model->id_position,
//        ]);
//        $model->fill(['id_vacancy_position' => $vanancy->id_vacancy]);
        $model->save();
        $this->resetModel();


        //event(new RepositoryEntityCreated(null,$model->tin_orgstruct,null,get_class($this->model)));

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

        if (empty($model)) {
            $this->resetModel();
            return 404;
        }

        $structures = $model->Structures()->first();

        if (empty($structures)) {
            $this->resetModel();
            abort(500, 'check parent structure');
        }

        if (Gate::denies('show-positions', $structures)) {
            $this->resetModel();
            return 403;
        }

        if (empty($model)) {
            $this->resetModel();
            return 404;
        }

        $this->resetModel();

        return $model;
    }


    /**
     * @param $id
     * @return int
     */
    public function delete($id)
    {

        $model = $this->find($id);

        if ($model === 404) {
            $this->resetModel();
            return 404;
        }

        if ($model === 403) {
            $this->resetModel();
            return 403;
        }


        $this->resetModel();
        if ($model) {

            if (!$model->status_open_position) {
                abort('424', 'U cant delete closed position');
            }

            $deleted = $model->delete();
            //event(new RepositoryEntityDeleted(null, $model->tin_orgstruct, null, get_class($this->model)));
            return $deleted;
        }

    }

    /**
     * @param $id_company_structure
     * @return mixed
     */
    public function getByOrgStruct($id_company_structure)
    {
        $model = $this->model->where('id_structure_position', $id_company_structure)->orderBy('id_position', 'desc')->get();

        $this->resetModel();

        return $model;
    }

    /**
     * @param $id_position
     * @return mixed
     */
    public function findWithStruct($id_position)
    {
        //TODO переписать на relation
        $model = $this->model->where('id_position', $id_position)
            ->leftJoin('structures', 'structures.id_structure', 'positions.id_structure_position')
            ->first();
        $this->resetModel();

        return $model;
    }

}
