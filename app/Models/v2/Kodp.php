<?php

namespace App\Models\v2;



/**
 * App\Models\v2\Kodp
 *
 * @property string|null $pn
 * @property string|null $name_ru
 * @property string|null $name_uz
 * @property string|null $nskz_code
 * @property string|null $min_education
 * @property string|null $personal_category
 * @property string|null $type
 * @property string|null $range
 * @method static \Illuminate\Database\Eloquent\Builder|Kodp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kodp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kodp query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kodp whereMinEducation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kodp whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kodp whereNameUz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kodp whereNskzCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kodp wherePersonalCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kodp wherePn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kodp whereRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kodp whereType($value)
 * @mixin BaseModel
 */
class Kodp extends BaseModel
{
    /**
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @var string
     */
    public $table = 'kodps';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'pn';

    /**
     * @var array
     */
    public $fillable = [];

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

}
