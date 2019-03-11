<?php

namespace App\Models\v2;



/**
 * App\Models\v2\Soato
 *
 * @property int|null $code
 * @property string|null $name_ru
 * @property string|null $name_uz
 * @property string|null $admincenter_ru
 * @property string|null $admincenter_uz
 * @method static \Illuminate\Database\Eloquent\Builder|Soato newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Soato newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Soato query()
 * @method static \Illuminate\Database\Eloquent\Builder|Soato whereAdmincenterRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Soato whereAdmincenterUz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Soato whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Soato whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Soato whereNameUz($value)
 * @mixin BaseModel
 */
class Soato extends BaseModel
{

    /**
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @var string
     */
    public $table = 'soatos';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = '';

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
