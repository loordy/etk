<?php

namespace App\Models\v2;



/**
 * App\Models\v2\Log
 *
 * @property int $id_log
 * @property int|null $id_user
 * @property string $user_pin_log
 * @property string|null $user_tin_log
 * @property string|null $time_log
 * @property string|null $sql_table
 * @property int|null $sql_operation
 * @property int|null $sql_row_id
 * @property mixed|null $sql_old_value Старое значение в виде JSON-строки
 * @property mixed|null $sql_new_value Новое значение в виде JSON-строки
 * @method static \Illuminate\Database\Eloquent\Builder|Log newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Log newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Log query()
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereIdLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereSqlNewValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereSqlOldValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereSqlOperation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereSqlRowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereSqlTable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereTimeLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereUserPinLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereUserTinLog($value)
 * @mixin BaseModel
 */
class Log extends BaseModel
{
//TODO собрать таблицу верно
    /**
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @var string
     */
    public $table = 'logs';

    /**
     * @var array
     */
    public $fillable = [

    ];

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
