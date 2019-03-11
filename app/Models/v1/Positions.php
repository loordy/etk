<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;



/**
 * Class Positions
 *
 * @package App\Models
 * @version November 2, 2018, 5:11 am UTC
 * @OA\Schema (
 *     title="Структура позиций",
 *     description="Структура позиций",
 *     required={
 *        "id_position"
 * },
 * example={
 * "status_open_position": true,
 *       "id_structure_position": 5,
 *      "name_position": "POS4_3",
 *      "date_end_position": null,
 *      "date_start_position": "2018-08-08 00:00:00.000000",
 *      "requirements_position": null,
 *      "form_position": null,
 *      "code_prof_position": "12    ",
 *      "salary_position": "1030000.00",
 *      "id_position": 6337,
 *      "id_vacancy_position": 3961
 *     },
 * @OA\Property (
 *     format="int64",
 *     title="Уникальный идентификатор должности",
 *     property="id_position",
 *     description="Уникальный идентификатор должности",
 * ),
 * @OA\Property (
 *     format="int64",
 *     title="Уникальный идентификатор структуры",
 *     property="id_structure",
 *     description="Уникальный идентификатор структуры",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Наименование должности",
 *     property="name_position",
 *     description="Наименование должности",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Код профессии (КОДП)",
 *     property="code_prof_position",
 *     description="Код профессии (КОДП)",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Оклад должностной",
 *     property="salary_position",
 *     description="Оклад должностной",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Требования к должности",
 *     property="requirements_position",
 *     description="Требования к должности",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Обязанности должности",
 *     property="duties_position",
 *     description="Обязанности должности",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Условия должности",
 *     property="conditions_position",
 *     description="Условия должности",
 * ),
 * @OA\Property (
 *     format="int64",
 *     title="Идентификатор вакансии в хранилище",
 *     property="id_vacancy_position",
 *     description="Идентификатор вакансии в хранилище",
 * ),
 * @OA\Property (
 *     format="int2",
 *     title="Вид занятости РМ",
 *     property="form_position",
 *     description="Вид занятости РМ",
 * ),
 * @OA\Property (
 *     format="boolean",
 *     title="Позиция не занята",
 *     property="status_open_position",
 *     description="Позиция не занята",
 * ),
 * @OA\Property (
 *     format="date",
 *     title="Дата конца",
 *     property="date_end_position",
 *     description="Позиция не занята",
 * ),
 * @OA\Property (
 *     format="boolean",
 *     title="Признак надбавка",
 *     property="flag_bonus_position",
 *     description="Признак надбавка",
 * ),
 * @OA\Property (
 *     format="integer",
 *     title="Тип занятости",
 *     property="type_emp_position",
 *     description="Тип занятости(описание в константах)",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Дополнительный идентификатор по кодп",
 *     property="code_prof_type_position",
 *     description="Дополнительный идентификатор по кодп(type в таблице кодп)",
 * ),
 * @OA\Property (
 *     format="numeric",
 *     title="Ставка должности",
 *     property="rate_position",
 *     description="Ставка должности",
 * ),
 * @OA\Property (
 *     format="date",
 *     title="Дата начала",
 *     property="date_start_position",
 *     description="Позиция не занята",
 * )
 * )
 * @property int $id
 * @property int|null $structure_id Идентификатор структуры организации
 * @property string|null $name
 * @property string|null $kodp_pn
 * @property float|null $salary Оклад должностной
 * @property string|null $requirements Требования к должности
 * @property string|null $date_stop
 * @property string|null $date_start
 * @property string|null $kodp_type
 * @property string|null $duties
 * @property string|null $conditions
 * @property int|null $employment_type
 * @property bool|null $mark_of_surcharge
 * @property float|null $rate
 * @property int|null $terms_of_payment
 * @property string $company_tin
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\v1\Structures $Structures
 * @property-read \App\Models\v1\Vacancies $Vacancies
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Positions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Positions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Positions query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Positions whereCompanyTin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Positions whereConditions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Positions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Positions whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Positions whereDateStop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Positions whereDuties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Positions whereEmploymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Positions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Positions whereKodpPn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Positions whereKodpType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Positions whereMarkOfSurcharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Positions whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Positions whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Positions whereRequirements($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Positions whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Positions whereStructureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Positions whereTermsOfPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Positions whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Positions extends Model
{
    /**
     * @var string
     */
    public $table = 'positions';

    /**
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'id_position';

    /**
     * @var array
     */
    public $fillable = [
        'id_structure_position',
        'name_position',
        'code_prof_position',
        'salary_position',
        'requirements_position',
        'id_vacancy_position',
        'form_position',
        'status_open_position',
        'date_end_position',
        'date_start_position',
        'duties_position',
        'conditions_position',
        'code_prof_type_position',
        'flag_bonus_position',
        'type_emp_position',
        'term_salary_position',
        'rate_position',


        'tmp_name_ru_position',
        'tmp_name_uz_position',
        'tmp_nskz_code_position',
        'tmp_min_education_position',
        'tmp_personal_category_position',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_position' => 'float',
        'id_structure_position' => 'float',
        'name_position' => 'string',
        'code_prof_position' => 'string',
        'code_prof_type_position' => 'string',
        'code_nskz_position' => 'string',
        'duties_position' => 'string',
        'conditions_position' => 'string',
        'salary_position' => 'string',
        'requirements_position' => 'string',
        'id_vacancy_position' => 'float',
        'form_position' => 'integer',
        'term_salary_position' => 'integer',
        'flag_bonus_position' => 'boolean',
        'type_emp_position' => 'integer',
        'status_open_position' => 'boolean',
        'date_end_position' => 'date',
        'date_start_position' => 'date',
        'rate_position' => 'decimal:2',

        'tmp_name_ru_position' => 'string',
        'tmp_name_uz_position' => 'string',
        'tmp_nskz_code_position' => 'string',
        'tmp_min_education_position' => 'string',
        'tmp_personal_category_position' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * default values
     */

    protected $attributes = [
        'status_open_position' => true,
        'flag_bonus_position' => false,
        'rate_position' => 1.00,
        'term_salary_position' => 1,
    ];

    /**
     * @return string
     */
    public function getDateFormat()
    {
        return 'Y-m-d H:i:s.u';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     **/
    public function Vacancies()
    {
        return $this->hasOne(\App\Models\v1\Vacancies::class, 'id_position_vacancy', 'id_position')
            ->where('date_end_vacancy', null);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     **/
    public function Structures()
    {
        return $this->belongsTo(\App\Models\v1\Structures::class, 'id_structure_position', 'id_structure');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     **/
    public function Contracts()
    {
        return $this->hasOne(\App\Models\v1\Lc::class, 'id_position_lc', 'id_position')->where('date_end_lc', null)->first();
    }

}
