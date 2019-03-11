<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\v1\Errors
 *
 * @property int $id_err
 * @property string|null $desc_err_ru
 * @property string|null $desc_err_uz
 * @property string $code
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Errors newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Errors newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Errors query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Errors whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Errors whereDescErrRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Errors whereDescErrUz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Errors whereIdErr($value)
 * @mixin \Eloquent
 */
class Errors extends Model
{

    /**
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @var string
     */
    public $table = 'errors';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'id_err';

    /**
     * @var array
     */
    public $fillable = [
        'desc_err_ru',
        'desc_err_uz',
        'code'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'desc_err_ru' => 'string',
        'desc_err_uz' => 'string',
        'code' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
