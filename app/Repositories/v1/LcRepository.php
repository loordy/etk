<?php

namespace App\Repositories\v1;

use App\Models\v1\Lc;
use Illuminate\Support\Facades\Cache;
use App\Events\RepositoryEntityCreated;
use App\Events\RepositoryEntityUpdated;
use App\Events\RepositoryEntityDeleted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\v1\Structures;
use App\Repositories\v1\LcWhRepository;
use App\Repositories\v1\PositionsRepository;
use App\Repositories\v1\VacanciesRepository;
use App\Events\LogEvent;
use App\Models\v1\PositionsWithContracts;



/**
 * Class LcRepository
 * @package App\Repositories
 * @version November 2, 2018, 5:11 am UTC
 */
class LcRepository extends BaseApiv1Repository
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
        return Lc::class;
    }

    /**
     * @param array $attributes
     */
    public function create(array $attributes)
    {
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function createStart(array $attributes)
    {

        //TODO нужен рефакторинг
        $attributes['owner_lc'] = Auth::user()->id_user;
        $attributes['owner_pin_lc'] = Auth::user()->pin_user;
        $attributes['owner_region_lc'] = Auth::user()->soato_company_user;
        $attributes['owner_tin_lc'] = Auth::user()->tin_company_user;
        $attributes['active_lc'] = true;
        $attributes['direct_lc'] = true;

        $modelLc = $this->model->fill($attributes);

        if (Gate::denies('create-lc', $modelLc)) {
            $this->resetModel();
            return 403;
        };

        $modelLc->save();
        $attributes['id_lc'] = $modelLc->id_lc;
       // $repoLcWh = new LcWhRepository(app());
       // $modelLc->fill(['id_lc_wh' => $repoLcWh->create($attributes)->id_lc_wh]);
       // $modelLc->save();

        $position = $modelLc->Positions();
        $position->update(['status_open_position' => false]);
        //$position->first()->Vacancies()->orderBy('id_vacancy', 'desc')->first()->update(['date_end_vacancy' => $modelLc->date_of_contract_lc]);

        //event(new LogEvent(Auth::user()->id_user, $modelLc->toArray()));
        $this->resetModel();
        return $modelLc;

    }

    /**
     * @param array $attributes
     * @param $id
     * @return mixed
     */
    public function updateStart(array $attributes, $id)
    {

        //TODO нужен рефакторинг
        $attributes['owner_lc'] = Auth::user()->id_user;
        $attributes['owner_pin_lc'] = Auth::user()->pin_user;
        $attributes['owner_region_lc'] = Auth::user()->soato_company_user;
        $attributes['owner_tin_lc'] = Auth::user()->tin_company_user;

        $modelLcOld = $this->model->where('id_lc', $id)->where('direct_lc', true)->where('active_lc', true)->first();
        $this->resetModel();
        if (empty($modelLcOld)) {
            $this->resetModel();
            return 404;
        }
        if (Gate::denies('update-start-lc', $modelLcOld)) {
            $this->resetModel();
            return 403;
        };
        //TODO релейшены... :(
        $attributesNew = $modelLcOld->toArray();
        $attributesNew['edit_id_lc'] = $modelLcOld->id_lc;
        $modelLc = $this->model->fill($attributesNew);
        $modelLc->fill($attributes);
        $modelLcOld->fill(['active_lc' => false]);
        $modelLcOld->save();
        $modelLc->save();

        $attributes['id_lc'] = $modelLc->id_lc;

        //$repoLcWh = new LcWhRepository(app());
        //$repoLcWh->update($attributes, $modelLc->id_lc_wh);

        $position = $modelLc->Positions();
        //$position->update(['status_open_position' => false]);
        //$position->first()->Vacancies()->orderBy('id_vacancy', 'desc')->first()->update(['date_end_vacancy' => $modelLc->date_of_contract_lc]);

        $this->resetModel();

        return $modelLc;

    }


    /**
     * @param $id
     */
    public function delete($id)
    {
    }

    /**
     * @param array $attributes
     * @param $id
     * @return mixed
     */
    public function stop(array $attributes, $id)
    {
        $attributes['owner_lc'] = Auth::user()->id_user;
        $attributes['owner_pin_lc'] = Auth::user()->pin_user;
        $attributes['owner_region_lc'] = Auth::user()->soato_company_user;
        $attributes['owner_tin_lc'] = Auth::user()->tin_company_user;
        $attributes['active_lc'] = true;
        $attributes['direct_lc'] = false;
        $attributes['parent_id_lc'] = $id;

        $modelLcStart = $this->model->where('id_lc', $id)->where('direct_lc', true)->where('active_lc', true)->first();
        $this->resetModel();
        if (empty($modelLcStart)) {
            return 404;
        }

        if (Gate::denies('update-start-lc', $modelLcStart)) {
            $this->resetModel();
            return 403;
        };

        $modelLcStart->fill([
            'date_end_lc' => $attributes['date_end_lc']
        ]);

        $modelLc = $this->model->fill($modelLcStart->toArray());

        $modelLc->fill($attributes);

        if (Gate::denies('create-lc', $modelLc)) {
            $this->resetModel();
            return 403;
        };
        $modelLcStart->save();
        $modelLc->save();
        //исправить
//        $attributesWh = $modelLcStart->toArray();
//
//        $attributesWh['id_wb'] = $modelLc->id_lc;


//        $repoLcWh = new LcWhRepository(app());
//        $repoLcWh->update($attributesWh, $modelLcStart->id_lc_wh);

        $position = $modelLc->Positions();
        $position->update(['status_open_position' => true]);
//        $structures = $position->first()->Structures()->first();
//        $position = $position->first();
//        $position->first()->Vacancies()->create([
//            'tin_company_vacancy' => $structures->tin_company_structure,
//            'region_vacancy' => $structures->region_structure,
//            'oked_vacancy' => $structures->oked_structure,
//            'name_company_vacancy' => $structures->name_structure,
//            'name_structure_vacancy' => $structures->name_structure,
//            'name_position_vacancy' => $position->name_position,
//            'code_prof_vacancy' => $position->code_prof_position,
//            'salary_vacancy' => $position->salary_position,
//            'request_vacancy' => $position->requirements_position,
//            'region4_vacancy' => $structures->region4_structure,
//            'date_end_vacancy' => $position->date_end_position,
//            'date_start_vacancy' => $modelLc->date_start_lc,
//            'id_position_vacancy' => $position->id_position,
//        ]);

//event(new LogEvent(Auth::user()->id_user, $modelLc->toArray()));
        $this->resetModel();
        return $modelLc;


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
     * @param $tin
     * @return mixed
     */
    public function getByTin($tin)
    {
        // return Cache::tags([$tin, get_class($this->model)])->remember('getLcByTin', $this->getCacheMinutes(), function () use ($tin) {
        $model = $this->model
            ->where('tin_lc', $tin)
            ->where('active_lc', true)
            ->where('direct_lc', true)
            ->get();
        $this->resetModel();
        return $model;
        //   });
    }


    /**
     * @param $tin
     * @return mixed
     */
    public function getByTinArchive($tin, $date)
    {
        // return Cache::tags([$tin, get_class($this->model)])->remember('getLcByTin', $this->getCacheMinutes(), function () use ($tin) {
        $model = $this->model->where('tin_lc', $tin)
            ->where('active_lc', true)
            ->where('direct_lc', true)
            ->where('date_end_lc', '!=', null);
        $model->when($date, function ($q, $date) {
            return $q->where('date_start_lc', '<', $date)
                ->where('date_end_lc', '>', $date);
        });
        $data = $model->get();
        $this->resetModel();
        return $data;
        //   });
    }

    /**
     * @param $pin
     * @return mixed
     */
    public function getByPin($pin)
    {
        // return Cache::tags([$pin, get_class($this->model)])->remember('getLcByPin', $this->getCacheMinutes(), function () use ($pin) {
        $model = $this->model
            ->where('pin_lc', $pin)
            ->get();
        $this->resetModel();
        return $model;
        //   });
    }

    /**
     * @param $id_struct
     * @param $tin
     * @return mixed
     */
    public function getByStructure($id_struct)
    {

        $model = PositionsWithContracts::where('id_structure',$id_struct)
            ->get();
        $this->resetModel();
        return $model;
    }

    public function getByMainWork($pin, $date)
    {

        $model = $this->model
            ->where('tin_lc', $pin)
            ->where('active_lc', true)
            ->where('main_work_lc', true)
            ->where('date_start_lc', '>=', $date)
            ->where('date_end_lc', '<=', $date)
            ->first();
        $this->resetModel();
        return $model;
    }


    public function getStatistic($tin)
    {

        $statistic = DB::select('select structures.name_structure as company_name, positions_with_active_contracts.tin_company_structure as сompany_tin,
structures.region_structure as soato,
count(id_position) as workplaces,
count(id_position) - SUM( CASE WHEN id_lc>0 and date_end_lc is null then 1 ELSE 0 END) as vacancies,
SUM(rate_position) as total_rates,
SUM(rate_position) - SUM( CASE WHEN id_lc>0  then rate_lc ELSE 0 END) as vacant_rates,
SUM( CASE WHEN id_lc>0 and date_end_lc is null then 1 ELSE 0 END)  as employed,
SUM( CASE WHEN id_lc>0  and gender_lc = true and date_end_lc is null then 1 ELSE 0 END) as active_contracts_in_gender_male,
SUM( CASE WHEN id_lc>0  and gender_lc = false and date_end_lc is null then 1 ELSE 0 END) as active_contracts_in_gender_female
from positions_with_active_contracts
join structures on structures.tin_company_structure = positions_with_active_contracts.tin_company_structure and structures.parent_id_structure is null
group by positions_with_active_contracts.tin_company_structure, structures.name_structure, structures.region_structure
having positions_with_active_contracts.tin_company_structure = :tin',
            ['tin' => $tin]);

        $statistic = $statistic;

        return $statistic;
    }

    public function update(array $attributes, $id)
    {

        $model = $this->model->findOrFail($id);

        $model->fill($attributes);
        $model->save();
        $this->resetModel();

        return $model;

    }


}
