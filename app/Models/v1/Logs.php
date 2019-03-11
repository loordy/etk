<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\v1\Logs
 *
 * @property int $id_log
 * @property int|null $id_user
 * @property string $user_pin_log
 * @property string|null $user_tin_log
 * @property string|null $time_log
 * @property string|null $sql_table
 * @property int|null $sql_operation
 * @property int|null $sql_row_id
 * @property string|null $sql_old_value Старое значение в виде JSON-строки
 * @property string|null $sql_new_value Новое значение в виде JSON-строки
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Logs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Logs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Logs query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Logs whereIdLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Logs whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Logs whereSqlNewValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Logs whereSqlOldValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Logs whereSqlOperation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Logs whereSqlRowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Logs whereSqlTable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Logs whereTimeLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Logs whereUserPinLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Logs whereUserTinLog($value)
 * @mixin \Eloquent
 */
class Logs extends Model
{

    /**
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @var string
     */
    public $table = 'logs';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'id_log';

    /**
     * @var array
     */
    public $fillable = [
        'id_log',
        'id_user',
        'user_pin_log',
        'user_tin_log',
        'time_log',
        'sql_table',
        'sql_operation',
        'sql_row_id',
        'sql_old_value',
        'sql_new_value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_pin_log' => 'string',
        'user_tin_log' => 'string',
        'sql_table' => 'string',
        'sql_old_value' => 'string',
        'sql_new_value' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
