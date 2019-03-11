<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\v1\Constants
 *
 * @property int $id_const
 * @property int|null $group_const
 * @property string|null $code_const
 * @property int|null $type_const
 * @property array|null $value_const_ru
 * @property array|null $value_const_uz
 * @property string|null $commentconst Комментарий
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Constants newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Constants newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Constants query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Constants whereCodeConst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Constants whereCommentconst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Constants whereGroupConst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Constants whereIdConst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Constants whereTypeConst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Constants whereValueConstRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Constants whereValueConstUz($value)
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $group
 * @property string|null $code
 * @property int|null $type
 * @property mixed|null $value_ru
 * @property mixed|null $value_uz
 * @property string|null $comment Комментарий
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Constants whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Constants whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Constants whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Constants whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Constants whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Constants whereValueRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Constants whereValueUz($value)
 */
class Constants extends Model
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
    protected $primaryKey = 'id_const';

    /**
     * @var array
     */
    public $fillable = [
        'group_const',
        'code_const',
        'type_const',
        'value_const_ru',
        'value_const_uz',
        'commentconst'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'code_const' => 'string',
        'value_const_ru' => 'array',
        'value_const_uz' => 'array',
        'commentconst' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
