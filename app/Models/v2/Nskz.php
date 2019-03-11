<?php

namespace App\Models\v2;



/**
 * App\Models\v2\Nskz
 *
 * @property int|null $code
 * @property string|null $name
 * @method static \Illuminate\Database\Eloquent\Builder|Nskz newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nskz newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nskz query()
 * @method static \Illuminate\Database\Eloquent\Builder|Nskz whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nskz whereName($value)
 * @mixin BaseModel
 */
class Nskz extends BaseModel
{

    /**
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @var string
     */
    public $table = 'nskzs';

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
