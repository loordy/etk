<?php

namespace App\Models\v2;



use Illuminate\Support\Facades\Auth;

/**
 * App\Models\v2\Transaction
 *
 * @property int $id
 * @property bool $active
 * @property bool $action
 * @property int|null $parent_id
 * @property int|null $error_id
 * @property int $type
 * @property string $person_pin
 * @property string $person_tin
 * @property string $person_passport
 * @property string $person_name
 * @property string $person_surname
 * @property string|null $person_patronymic
 * @property bool $person_sex
 * @property bool|null $person_phone_number
 * @property string $company_tin
 * @property string $company_name
 * @property string $company_oked
 * @property string $company_soato_code
 * @property int|null $structure_id
 * @property string $structure_name
 * @property int|null $position_id
 * @property string $position_name
 * @property int|null $contract_number
 * @property float $contract_rate
 * @property \Illuminate\Support\Carbon $date_start
 * @property \Illuminate\Support\Carbon $date_stop
 * @property string $contract_date
 * @property float|null $contract_salary
 * @property mixed $contract_data
 * @property bool $contract_mark_main
 * @property bool $contract_mark_surcharge
 * @property int $contract_type
 * @property bool $mark_confirmation
 * @property string $kodp_nskz_code
 * @property string $kodp_pn
 * @property string $kodp_type
 * @property string $kodp_personal_category
 * @property \Illuminate\Support\Carbon|null $order_date
 * @property string|null $order_number
 * @property string|null $order_article
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float|null $contract_rate_coefficient
 * @property int|null $contract_rank
 * @property-read Transaction $Child
 * @property-read Company $Company
 * @property-read Transaction|null $Error
 * @property-read Transaction|null $Parent
 * @property-read Position|null $Position
 * @property-read Structure|null $Structure
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCompanyOked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCompanySoatoCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCompanyTin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereContractData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereContractDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereContractMarkMain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereContractMarkSurcharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereContractNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereContractRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereContractRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereContractRateCoefficient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereContractSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereContractType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDateStop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereErrorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereKodpNskzCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereKodpPersonalCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereKodpPn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereKodpType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereMarkConfirmation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereOrderArticle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereOrderDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePersonName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePersonPassport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePersonPatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePersonPhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePersonPin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePersonSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePersonSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePersonTin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePositionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStructureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStructureName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @mixin BaseModel
 */
class Transaction extends BaseModel
{

    /**
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @var array
     */
    public $fillable = [

        'active',
        'action',
        'parent_id',
        'error_id',
        'type',

        'person_pin',
        'person_tin',
        'person_passport',
        'person_name',
        'person_surname',
        'person_patronymic',
        'person_sex',
        'person_phone_number',

        'company_tin',
        'company_name',
        'company_oked',
        'company_soato_code',

        'structure_id',
        'structure_name',

        'position_id',
        'position_name',

        'contract_number',
        'contract_date',
        'contract_salary',
        'contract_data',
        'contract_mark_main',
        'contract_mark_surcharge',
        'contract_type',
        'contract_rate',
        'contract_rate_coefficient',
        'contract_rank',
        'contract_data',



        'date_start',
        'date_stop',
        'mark_confirmation',

        'kodp_nskz_code',
        'kodp_pn',
        'kodp_type',
        'kodp_personal_category',

        'order_date',
        'order_number',
        'order_article',

        'created_by',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_start' => 'date',
        'date_stop' => 'date',
        'contract_date' => 'date',
        'order_date' => 'date',
        'contract_data' => 'array',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


    /**
     * Default attributes
     * @var array
     */
    protected $attributes = [
        'mark_confirmation' => false,
        'date_stop' => '9999-01-01',
        'action' => true,
        'active' => true,
        'type' => 1
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'date_stop',
    ];

    /**
     *
     */
    protected static function boot()
    {
        static::creating(function ($model) {
            $model->created_by = Auth::id();
        });
        parent::boot();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     **/
    public function Position()
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     **/
    public function Structure()
    {
        return $this->belongsTo(Structure::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Parent()
    {
        return $this->belongsTo(Transaction::class,'parent_id')->where('active',true);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function Child()
    {
        return $this->hasOne(Transaction::class,'parent_id')->where('active',true);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Error()
    {
        return $this->belongsTo(Transaction::class,'error_id');
    }

    public function Deactivate(){
        $this->active = false;
        $this->save();
    }

}
