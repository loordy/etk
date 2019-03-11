<?php

namespace App\Repositories\v1;

use App\Models\v1\PositionsWithContracts;
use Illuminate\Support\Facades\DB;


/**
 * Class VacancyRepository
 * @package App\Repositories
 * @version November 2, 2018, 5:10 am UTC
 *
*/
class ReportsRepository extends BaseApiv1Repository
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
        return PositionsWithContracts::class;
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

    /**
     * @param $id
     * @return int
     */
    public function getStatistic($soato)
    {

        $statistic = DB::select(DB::raw("select structures.name_structure as company_name, positions_with_active_contracts.tin_company_structure as сompany_tin,
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
where structures.region_structure like '".$soato."%'
group by positions_with_active_contracts.tin_company_structure, structures.name_structure, structures.region_structure"));

            return $statistic;

    }

    /**
     * @param $soato
     * @return array
     */

    public function getStatisticBySoato($soato)
    {

        $soatoMod = strlen( $soato ) == 2 ? $soato . '__' : $soato . '___';

        $statistic = DB::select('select soato,
	sum(company_count) as company_count,
	sum(workplaces) as workplaces,
	sum(vacancies) as vacancies,
	sum(total_rates) as total_rates,
	sum(vacant_rates) as vacant_rates,
	sum(employed) as employed,
	sum(active_contracts_in_gender_male) as active_contracts_in_gender_male,
	sum(active_contracts_in_gender_female) as active_contracts_in_gender_female
	from	(select substring(soato.code::text for :len) as soato,
			count(company.tin) as company_count,
			sum(company.total_positions) as workplaces,
			sum(company.total_positions) - sum(company.total_active_contracts) as vacancies,
			sum(company.total_rates) as total_rates,
			sum(company.total_rates) - sum(company.closed_rates) as vacant_rates,
			sum(company.total_active_contracts) as employed,
			sum(company.active_contracts_in_gender_male) as active_contracts_in_gender_male,
			sum(company.active_contracts_in_gender_female) as active_contracts_in_gender_female
			from	(select 
					structures.region_structure as soato,
					positions_with_active_contracts.tin_company_structure as tin, 
					t.c as total_contracts,
					count(id_position) as total_positions,
					SUM( CASE WHEN id_lc>0 and date_end_lc is null then 1 ELSE 0 END)  as total_active_contracts,
					SUM( CASE WHEN id_lc>0  and type_emp_lc = 1 and date_end_lc is null then 1 ELSE 0 END) as active_contracts_in_type_emp_1,
					SUM( CASE WHEN id_lc>0  and type_emp_lc = 2 and date_end_lc is null then 1 ELSE 0 END) as active_contracts_in_type_emp_2,
					SUM( CASE WHEN id_lc>0  and type_emp_lc = 3 and date_end_lc is null then 1 ELSE 0 END) as active_contracts_in_type_emp_3,
					SUM( CASE WHEN id_lc>0  and type_emp_lc = 4 and date_end_lc is null then 1 ELSE 0 END) as active_contracts_in_type_emp_4,
					SUM( CASE WHEN id_lc>0  and type_emp_lc = 5 and date_end_lc is null then 1 ELSE 0 END) as active_contracts_in_type_emp_5,
					SUM( CASE WHEN id_lc>0  and type_emp_lc = 6 and date_end_lc is null then 1 ELSE 0 END) as active_contracts_in_type_emp_6,
					SUM( CASE WHEN id_lc>0  and type_emp_lc = 7 and date_end_lc is null then 1 ELSE 0 END) as active_contracts_in_type_emp_7,
					SUM( CASE WHEN id_lc>0  and gender_lc = true and date_end_lc is null then 1 ELSE 0 END) as active_contracts_in_gender_male,
					SUM( CASE WHEN id_lc>0  and gender_lc = false and date_end_lc is null then 1 ELSE 0 END) as active_contracts_in_gender_female,
					SUM(rate_position) as total_rates,
					SUM( CASE WHEN id_lc>0  then rate_lc ELSE 0 END) as closed_rates

					from positions_with_active_contracts
					join structures on structures.tin_company_structure = positions_with_active_contracts.tin_company_structure and structures.parent_id_structure is null
					left join (select tin_lc, count(*) as c from lc where active_lc = true and direct_lc = true group by tin_lc) t on t.tin_lc =  positions_with_active_contracts.tin_company_structure
					group by positions_with_active_contracts.tin_company_structure,structures.region_structure,t.c) company
					right join soato on soato.code::text = company.soato
					group by soato.code) predicate
					group by soato having soato like :soatoMod or soato = :soato',
            ['soato' => $soato, 'soatoMod' => $soatoMod, 'len' => strlen( $soatoMod )]);

        return $statistic;

    }
}
