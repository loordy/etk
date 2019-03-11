<?php

namespace App\Models\v2;



/**
 * App\Models\v2\Structure
 *
 * @property int $id Идентификатор структуры организации
 * @property float|null $parent_id Идентификатор структуры организации
 * @property string $name Наименование структуры (организации)
 * @property string|null $company_tin ИНН ЮЛ
 * @property string|null $date_stop
 * @property \Illuminate\Support\Carbon|null $date_start
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Company|null $Company
 * @property-read \Illuminate\Database\Eloquent\Collection|Position[] $Positions
 * @method static \Illuminate\Database\Eloquent\Builder|Structure newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Structure newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Structure query()
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereCompanyTin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereDateStop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereUpdatedAt($value)
 * @mixin BaseModel
 */
class Structure extends BaseModel
{

    /**
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @var string
     */
    public $table = 'structures';

    /**
     * @var array
     */
    public $fillable = [
        'parent_id',
        'name',
        'company_tin',
        'date_stop',
        'date_start',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'parent_id' => 'float',
        'name' => 'string',
        'tin_company' => 'string',
        'date_end' => 'date',
        'date_start' => 'date',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     */
    public function Positions()
    {
        return $this->hasMany(Position::class);
    }

}
