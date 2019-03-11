<?php

namespace App\Models\v2;


/**
 * App\Models\v2\Constant
 *
 * @property int $id
 * @property int|null $group
 * @property string|null $code
 * @property int|null $type
 * @property array|null $value_ru
 * @property array|null $value_uz
 * @property string|null $comment Комментарий
 * @method static \Illuminate\Database\Eloquent\Builder|Constant whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Constant whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Constant whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Constant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Constant whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Constant whereValueRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Constant whereValueUz($value)
 * @mixin BaseModel
 */
class Constant extends BaseModel
{
    /**
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @var string
     */
    public $table = 'constants';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    public $fillable = [
        'group',
        'code',
        'type',
        'value_ru',
        'value_uz',
        'comment'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'group' => 'string',
        'value_ru' => 'array',
        'value_uz' => 'array',
        'code' => 'string',
        'type' => 'string',
        'comment' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
