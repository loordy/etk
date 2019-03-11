<?php

namespace App\Models\v2;



/**
 * App\Models\v2\PositionWithActiveTransaction
 *
 * @property int|null $id
 * @property float|null $structure_id
 * @property string|null $name
 * @property string|null $kodp_pn
 * @property mixed|null $salary
 * @property string|null $requirements
 * @property \Illuminate\Support\Carbon|null $date_stop
 * @property \Illuminate\Support\Carbon|null $date_start
 * @property string|null $duties
 * @property string|null $conditions
 * @property string|null $kodp_type
 * @property bool|null $mark_of_surcharge
 * @property int|null $employment_type
 * @property int|null $terms_of_payment
 * @property string|null $company_tin
 * @property mixed|null $rate
 * @property float|null $contract_id
 * @property string|null $person_pin
 * @property string|null $person_tin
 * @property string|null $person_passport
 * @property string|null $person_name
 * @property string|null $person_surname
 * @property string|null $person_patronymic
 * @property bool|null $person_gender
 * @property mixed|null $contract_rate
 * @property \Illuminate\Support\Carbon|null $contract_date_start
 * @property \Illuminate\Support\Carbon|null $contract_date_stop
 * @property \Illuminate\Support\Carbon|null $signing_date
 * @property mixed|null $contract_salary
 * @property bool|null $mark_of_the_main_work
 * @property bool|null $contract_mark_of_surcharge
 * @property int|null $contract_employment_type
 * @property int|null $contract_terms_of_payment
 * @property bool|null $employee_confirmation
 * @property float|null $updated_by
 * @property bool|null $status_open
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereCompanyTin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereConditions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereContractDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereContractDateStop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereContractEmploymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereContractMarkOfSurcharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereContractRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereContractSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereContractTermsOfPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereDateStop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereDuties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereEmployeeConfirmation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereEmploymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereKodpPn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereKodpType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereMarkOfSurcharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereMarkOfTheMainWork($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction wherePersonGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction wherePersonName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction wherePersonPassport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction wherePersonPatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction wherePersonPin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction wherePersonSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction wherePersonTin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereRequirements($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereSigningDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereStatusOpen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereStructureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereTermsOfPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionWithActiveTransaction whereUpdatedBy($value)
 * @mixin BaseModel
 */
class PositionWithActiveTransaction extends BaseModel
{


    /**
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @var string
     */
    public $table = 'positions_with_active_transaction';

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


}
