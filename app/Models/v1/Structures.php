<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Structure
 *
 * @package App\Models
 * @version November 2, 2018, 5:10 am UTC
 * @OA\Schema (
 *     title="Структура организации",
 *     description="Структура организации",
 *     required={
 *       "id_structure",
 *       "name_structure",
 *     },
 *     example={
 *          "id_structure": 2044,
 *          "parent_id_structure": 5,
 *          "name_structure": "Отдел чего то там2",
 *          "tin_company_structure": "123123123",
 *          "oked_structure": null,
 *          "region_structure": null,
 *          "region4_structure": null,
 *          "root_id_structure": "6",
 *          "data_structure": null,
 *          "date_end_structure": null,
 *          "date_start_structure": "2017-12-12"
 *     },
 * @OA\Property (
 *     format="int64",
 *     title="Уникальный идентификатор структуры",
 *     property="id_structure",
 *     description="Уникальный идентификатор структуры",
 * ),
 * @OA\Property (
 *     format="int64",
 *     title="Родительская запись стр.орг.",
 *     property="parent_id_structure",
 *     description="Родительская запись стр.орг.",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Наименование структуры",
 *     property="name_structure",
 *     description="Наименование структуры",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="ИНН ЮЛ в структуре организации",
 *     property="tin_company_structure",
 *     description="ИНН ЮЛ в структуре организации",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Код ОКЭД",
 *     property="oked_structure",
 *     description="Код ОКЭД",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="СОАТО структуры",
 *     property="region_structure",
 *     description="СОАТО структуры",
 * ),
 * @OA\Property (
 *     format="int64",
 *     title="СОАТО структуры 4 знака",
 *     property="region4_structure",
 *     description="СОАТО структуры 4 знака",
 * ),
 * @OA\Property (
 *     format="int64",
 *     title="Ссылка на корневую запись структуры",
 *     property="root_id_structure",
 *     description="Ссылка на корневую запись структуры",
 * ),
 * @OA\Property (
 *     format="array",
 *     title="",
 *     property="data_structure",
 *     description="",
 * ),
 * @OA\Property (
 *     format="date",
 *     title="Дата конца",
 *     property="date_end_structure",
 *     description="",
 * ),
 * @OA\Property (
 *     format="date",
 *     title="Дата начала",
 *     property="date_start_structure",
 *     description="",
 * )
 * )
 * @property int $id Идентификатор структуры организации
 * @property int|null $parent_id Идентификатор структуры организации
 * @property string $name Наименование структуры (организации)
 * @property string|null $company_tin ИНН ЮЛ
 * @property string|null $date_stop
 * @property string|null $date_start
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Structures newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Structures newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Structures query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Structures whereCompanyTin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Structures whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Structures whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Structures whereDateStop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Structures whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Structures whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Structures whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Structures whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Structures extends Model
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
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'id_structure';


    /**
     * @var array
     */
    public $fillable = [
        'parent_id_structure',
        'name_structure',
        'tin_company_structure',
        'oked_structure',
        'region_structure',
        'region4_structure',
        'root_id_structure',
        'data_structure',
        'date_end_structure',
        'date_start_structure',




    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'parent_id_structure' => 'float',
        'name_structure' => 'string',
        'tin_company_structure' => 'string',
        'oked_structure' => 'string',
        'region_structure' => 'string',
        'region4_structure' => 'string',
        'root_id_structure' => 'string',
        'data_structure' => 'array',
        'date_end_structure' => 'date',
        'date_start_structure' => 'date',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * @return string
     */
    public function getDateFormat()
    {
        return 'Y-m-d H:i:s.u';
    }


}
