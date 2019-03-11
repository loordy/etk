<?php

namespace App\Models\v2;


use Carbon\Carbon;


/**
 * App\Models\v2\Position
 *
 * @property int $id
 * @property float|null $structure_id Идентификатор структуры организации
 * @property string|null $name
 * @property string|null $kodp_pn
 * @property mixed|null $salary Оклад должностной
 * @property string|null $requirements Требования к должности
 * @property mixed|null $date_stop
 * @property mixed|null $date_start
 * @property string|null $kodp_type
 * @property string|null $duties
 * @property string|null $conditions
 * @property int|null $type
 * @property bool|null $mark_surcharge
 * @property mixed|null $rate
 * @property mixed|null $rate_coefficient
 * @property int|null $rank
 * @property string $company_tin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Transaction $ActiveTransaction
 * @property-read Company $Company
 * @property-read Kodp|null $Kodp
 * @property-read Structure|null $Structure
 * @property-read \Illuminate\Database\Eloquent\Collection|Transaction[] $Transactions
 * @method static \Illuminate\Database\Eloquent\Builder|Position newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Position newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Position query()
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereCompanyTin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereConditions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereDateStop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereDuties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereKodpPn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereKodpType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereMarkSurcharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereRateCoefficient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereRequirements($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereStructureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereUpdatedAt($value)
 * @mixin BaseModel
 */
class Position extends BaseModel
{
    /**
     * @var string
     */
    public $table = 'positions';

    /**
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @var array
     */
    public $fillable = [
        'structure_id',
        'name',
        'kodp_pn',
        'salary',
        'requirements',
        'date_stop',
        'date_start',
        'duties',
        'conditions',
        'kodp_type',
        'mark_surcharge',
        'type',
        'company_tin',
        'rate',
        'rate_coefficient',
        'rank',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'structure_id' => 'float',
        'name' => 'string',
        'kodp_pn' => 'string',
        'salary' => 'numeric',
        'requirements' => 'string',
        'date_stop' => 'date',
        'date_start' => 'date',
        'duties' => 'string',
        'conditions' => 'string',
        'company_tin' => 'string',
        'kodp_type' => 'string',
        'mark_surcharge' => 'boolean',
        'type' => 'integer',
        'rate' => 'numeric',
        'rate_coefficient' => 'numeric',
        'rank' => 'integer',
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
        'date_stop' => '9999-01-01'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     **/
    public function Structure()
    {
        return $this->belongsTo(Structure::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     **/
    public function ActiveTransaction()
    {
        return $this->hasOne(Transaction::class)
            ->where('date_start', '<=', Carbon::now())
            ->where('date_stop', '>=', Carbon::now());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function Transactions()
    {
        return $this->hasMany(Transaction::class);
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
    public function Kodp()
    {
        return $this->belongsTo(Kodp::class)->where('type', $this->kodp_type);
    }


    /**
     * @param string $date
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ActiveTransactionOnDate(string $date)
    {
        return $this->hasOne(Transaction::class)->where('date_stop', '>=', $date)->where('active',true);
    }


}
