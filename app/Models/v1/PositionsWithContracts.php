<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;




/**
 * App\Models\v1\PositionsWithContracts
 *
 * @property int|null $id
 * @property int|null $structure_id
 * @property string|null $name
 * @property string|null $kodp_pn
 * @property float|null $salary
 * @property string|null $requirements
 * @property string|null $date_stop
 * @property string|null $date_start
 * @property string|null $duties
 * @property string|null $conditions
 * @property string|null $kodp_type
 * @property bool|null $mark_of_surcharge
 * @property int|null $employment_type
 * @property int|null $terms_of_payment
 * @property string|null $company_tin
 * @property float|null $rate
 * @property int|null $contract_id
 * @property string|null $person_pin
 * @property string|null $person_tin
 * @property string|null $person_passport
 * @property string|null $person_name
 * @property string|null $person_surname
 * @property string|null $person_patronymic
 * @property bool|null $person_gender
 * @property float|null $contract_rate
 * @property string|null $contract_date_start
 * @property string|null $contract_date_stop
 * @property string|null $signing_date
 * @property float|null $contract_salary
 * @property bool|null $mark_of_the_main_work
 * @property bool|null $contract_mark_of_surcharge
 * @property int|null $contract_employment_type
 * @property int|null $contract_terms_of_payment
 * @property bool|null $employee_confirmation
 * @property int|null $updated_by
 * @property bool|null $status_open
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereCompanyTin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereConditions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereContractDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereContractDateStop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereContractEmploymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereContractMarkOfSurcharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereContractRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereContractSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereContractTermsOfPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereDateStop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereDuties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereEmployeeConfirmation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereEmploymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereKodpPn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereKodpType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereMarkOfSurcharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereMarkOfTheMainWork($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts wherePersonGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts wherePersonName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts wherePersonPassport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts wherePersonPatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts wherePersonPin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts wherePersonSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts wherePersonTin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereRequirements($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereSigningDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereStatusOpen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereStructureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereTermsOfPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\PositionsWithContracts whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PositionsWithContracts extends Model
{


    /**
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @var string
     */
    public $table = 'positions_with_active_contracts';

    /**
     * @var string
     */
    protected $primaryKey = 'id_positions';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    public $fillable = [

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * default values
     */

    protected $attributes = [

    ];



    /**
     * @return string
     */
    public function getDateFormat()
    {
        return 'Y-m-d H:i:s.u';
    }




}
