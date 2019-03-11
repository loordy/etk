<?php

namespace App\Models\v2;



/**
 * App\Models\v2\Error
 *
 * @property int $id_err
 * @property string|null $desc_err_ru
 * @property string|null $desc_err_uz
 * @property string $code
 * @method static \Illuminate\Database\Eloquent\Builder|Error newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Error newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Error query()
 * @method static \Illuminate\Database\Eloquent\Builder|Error whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Error whereDescErrRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Error whereDescErrUz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Error whereIdErr($value)
 * @mixin BaseModel
 */
class Error extends BaseModel
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
