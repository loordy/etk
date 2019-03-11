<?php

namespace App\Repositories\v1;

use App\Models\v1\LcWh;
use Illuminate\Support\Facades\Cache;
use App\Events\RepositoryEntityCreated;
use App\Events\RepositoryEntityUpdated;
use App\Events\RepositoryEntityDeleted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\v1\Structures;


/**
 * Class LcRepository
 * @package App\Repositories
 * @version November 2, 2018, 5:11 am UTC
 */
class LcWhRepository extends BaseApiv1Repository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_lc',
        'parent_id_lc',
        'active_lc',
        'datetime_lc',
        'type_lc',
        'direct_lc',
        'edit_id_lc',
        'pin_lc',
        'taxper_lc',
        'passport_lc',
        'familyperson_lc',
        'nameperson_lc',
        'midlenameperson_lc',
        'tin_lc',
        'name_lc',
        'oked_lc',
        'regionent_lc',
        'department_lc',
        'position_lc',
        'prof_lc',
        'id_position',
        'salary_lc',
        'flagbonus_lc',
        'termsalaru_lc',
        'typeemp_lc',
        'codenskz_lc',
        'order_lc',
        'dateorder_lc',
        'article_lc',
        'specspo_lc',
        'codespo_ls',
        'specvo_ls',
        'codevo_ls',
        'acceptemployer_lc',
        'acceptemployee_lc',
        'warehouse_id',
        'value_fields_lc'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return LcWh::class;
    }

    public function create(array $attributes)
    {


        $model = $this->model->fill($attributes);

        $model->save();
        $this->resetModel();

        return $model;

    }

    public function update(array $attributes, $id)
    {

        $model = $this->model->findOrFail($id);

        $model->fill($attributes);
        $model->save();
        $this->resetModel();

        return $model;

    }
    public function createLc(array $attributes)
    {
//
//        $model = $this->model->fill($attributes);
//        $model->save();
//        $this->resetModel();

//        event(new RepositoryEntityCreated($model->pin_lc,$model->tin_lc,null,get_class($this->model)));
        unset($attributes['id_lc']);
        $attributes['salary_lc'] = (float)$attributes['salary_lc'];

        $json = json_encode($attributes);
        $lc = json_decode(DB::select('SELECT public."AddWorkContract1"(' . app('auth')->id() . ',\'' . $json . '\'::jsonb )')[0]->AddWorkContract1);
        event(new RepositoryEntityUpdated($lc->DATA->pin_lc, $lc->DATA->tin_lc, null, get_class($this->model)));
        return $lc;
    }

    public function updateLc(array $attributes, $id)
    {
        $attributes['salary_lc'] = (float)$attributes['salary_lc'];
        unset($attributes['id_lc']);
        unset($attributes['edit_id_lc']);
        unset($attributes['direct_lc']);
        unset($attributes['active_lc']);
        unset($attributes['parent_id_lc']);

        $json = json_encode($attributes);
        $lc = json_decode(DB::select('SELECT public."EditWorkContract1"(' . Auth::id() . ',' . $id . ' ,	\'' . $json . '\'::jsonb )')[0]->EditWorkContract1);
//        $model = $this->model->fill($attributes);
//        $model->save();
//        $this->resetModel();

//        event(new RepositoryEntityUpdated($model->pin_lc,$model->tin_lc,null,get_class($this->model)));
        event(new RepositoryEntityUpdated($lc->DATA[0]->pin_lc, $lc->DATA[0]->tin_lc, null, get_class($this->model)));
//        return $model;

        return $lc;
    }

    public function delete($id)
    {
    }

    public function stop(array $attributes, $id, $date)
    {
        unset($attributes['datetime_lc']);
        $attributes['salary_lc'] = (float)$attributes['salary_lc'];

        $json = json_encode($attributes);
        $lc = json_decode(DB::select('SELECT public."StopWorkContract1"(' . app('auth')->id() . ',' . $id . ',\'' . $date . '\'::date ,	\'' . $json . '\'::jsonb )')[0]->StopWorkContract1);
//        $model = $this->model->fill($attributes);
//        $model->save();
//        $this->resetModel();

//        event(new RepositoryEntityUpdated($model->pin_lc,$model->tin_lc,null,get_class($this->model)));
        event(new RepositoryEntityDeleted($lc->DATA[0]->pin_lc, $lc->DATA[0]->tin_lc, null, get_class($this->model)));
//        return $model;
        return $lc;
    }


    public function find($id, $columns = ['*'])
    {

        $model = $this->model->find($id, $columns);
        $this->resetModel();

        return $model;
    }

    public function getByTin($tin)
    {
        return Cache::tags([$tin, get_class($this->model)])->remember('getLcByTin', $this->getCacheMinutes(), function () use ($tin) {
            $model = $this->model
                ->where('tin_lc', $tin)
                ->where('active_lc', true)
                ->where('direct_lc', true)
                ->get();
            $this->resetModel();
            return $model;
        });
    }

    public function getByPin($pin)
    {
        return Cache::tags([$pin, get_class($this->model)])->remember('getLcByPin', $this->getCacheMinutes(), function () use ($pin) {
            $model = $this->model
                ->where('pin_lc', $pin)
                ->get();
            $this->resetModel();
            return $model;
        });
    }

    public function getByStructure($id_struct, $tin)
    {

        $model = $this->model
            ->where('tin_lc', $tin)
            ->where('active_lc', true)
            ->where('structures.id_struct', $id_struct)
            ->leftJoin('positions', 'lc.id_position', 'positions.id_position')
            ->leftJoin('structures', 'structures.id_struct', 'positions.id_struct')
            ->select('positions.id_position', 'positions.open_pos', 'lc.*')
            ->get();
        $this->resetModel();
        return $model;
    }

}
