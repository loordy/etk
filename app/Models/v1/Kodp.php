<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Kodp
 *
 * @package App\Models
 * @version October 31, 2018, 9:45 am UTC
 * @OA\Schema (
 *     title="КОДП",
 *     description="КОДП",
 *     example={
 *      "pn": "2250.",
 *      "_id_": "2302",
 *      "range": "1 — 8",
 *      "specs": null,
 *      "office": null,
 *      "worker": "1",
 *      "name_ru": "Машинист тепловоза",
 *      "name_uz": "Тепловоз машинисти",
 *      "education": null,
 *      "no_matter": null,
 *      "nskz_code": "8311",
 *      "_parent_id_": null,
 *      "admin_staff": null,
 *      "agriculture": null,
 *      "min_education": "ССПО",
 *      "tech_personal": null,
 *      "direction_code": "3310600",
 *      "service_personal": null,
 *      "personal_category": "П",
 *      "productive_personal": "1",
 *      "trade_food_services": null
 *     },
 * @OA\Property (
 *     format="string",
 *     title="Порядковый номер",
 *     property="pn",
 *     description="Порядковый номер",
 * ),
 * @OA\Property (
 *     format="int32",
 *     title="Ключ",
 *     property="_id_",
 *     description="Порядковый номер записи в таблице",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Диапазон квалификационных разрядов",
 *     property="range",
 *     description="Диапазон квалификационных разрядов",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Наименование профессий рабочих",
 *     property="specs",
 *     description="Наименование профессий рабочих",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Офис",
 *     property="office",
 *     description="Офис",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Рабочие",
 *     property="worker",
 *     description="Рабочие",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Наименование профессий рабочих",
 *     property="name_ru",
 *     description="Наименование профессий рабочих",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Касблар номи",
 *     property="name_uz",
 *     description="Касблар номи",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Образование",
 *     property="education",
 *     description="Образование",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Не важно",
 *     property="no_matter",
 *     description="Не важно",
 * ),
 * @OA\Property (
 *     format="int32",
 *     title="Код по НСКЗ",
 *     property="nskz_code",
 *     description="Код по НСКЗ",
 * ),
 * @OA\Property (
 *     format="int32",
 *     title="Ключ родителя",
 *     property="_parent_id_",
 *     description="Номер родительской записи в таблице",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Управленческий персонал",
 *     property="admin_staff",
 *     description="Управленческий персонал",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Сельское хозяйство",
 *     property="agriculture",
 *     description="Сельское хозяйство",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Требования к минимальному уровню образования",
 *     property="min_education",
 *     description="Требования к минимальному уровню образования",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Технический персонал",
 *     property="tech_personal",
 *     description="Технический персонал",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Код направления образования",
 *     property="direction_code",
 *     description="Код направления образования",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Обслуживающий персонал",
 *     property="service_personal",
 *     description="Обслуживающий персонал",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Категория персонала",
 *     property="personal_category",
 *     description="Категория персонала",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Производственный персонал",
 *     property="productive_personal",
 *     description="Производственный персонал",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Дополнительный идентификатор кодп",
 *     property="type",
 *     description="ТК порядковый номер не уникальный необходимо добавить 2 ключ для уникальности",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Торговля/общепит/услуги",
 *     property="trade_food_services",
 *     description="Торговля/общепит/услуги",
 * )
 * 
 * )
 * @property string|null $pn
 * @property string|null $name_ru
 * @property string|null $name_uz
 * @property string|null $nskz_code
 * @property string|null $min_education
 * @property string|null $personal_category
 * @property string|null $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Kodp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Kodp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Kodp query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Kodp whereMinEducation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Kodp whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Kodp whereNameUz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Kodp whereNskzCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Kodp wherePersonalCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Kodp wherePn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Kodp whereType($value)
 * @mixin \Eloquent
 * @property string|null $range
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Kodp whereRange($value)
 */
class Kodp extends Model
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


    /**
     * @param $text
     * @return mixed
     */
    public function searchRu($text)
    {
        return $this->where('name_ru', 'like', '%' . $text . '%')->limit(10)->get();
    }

    /**
     * @param $text
     * @return mixed
     */
    public function searchUz($text)
    {
        return $this->where('name_uz', 'like', '%' . $text . '%')->limit(10)->get();
    }
}
