<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\LcDefaultOrderByScope;
use Carbon\Carbon;


/**
 * Class Contract
 *
 * @package App\Models
 * @version November 2, 2018, 5:11 am UTC
 * @OA\Schema (
 *     title="Трудовые договоры",
 *     description="Трудовые договоры",
 *     required={
 *        "pin_lc",
 *        "tin_lc",
 *        "name_company_lc",
 *        "code_prof_lc",
 *        "tax_person_lc",
 *        "type_emp_lc",
 *        "passport_lc",
 *        "name_person_lc",
 *        "family_person_lc",
 *        "main_work_lc",
 *        "date_start_lc"
 * },
 *     example={
 *       "id_lc":11888,
 *       "parent_id_lc":9,
 *       "active_lc":true,
 *       "datetime_lc":"2018-11-29T12:42:33.141459",
 *       "type_lc":1,
 *       "direct_lc":false,
 *       "edit_id_lc":null,
 *       "pin_lc":"10100000000001",
 *       "tax_person_lc":"100000001",
 *       "passport_lc":"AA1000001",
 *       "family_person_lc":"F1",
 *       "name_person_lc":"N1",
 *       "middlename_person_lc":null,
 *       "tin_lc":"100000005",
 *       "name_company_lc":"ORG2",
 *       "oked_lc":"10002",
 *       "regionent_lc":"170311",
 *       "name_structure_lc":"ORG2",
 *       "name_position_lc":"POS1_5",
 *       "code_prof_lc":"5",
 *       "id_position_lc":5,
 *       "salary_lc":1050000,
 *       "flag_bonus_lc":null,
 *       "term_salary_lc":1,
 *       "type_emp_lc":1,
 *       "code_nskz_lc":null,
 *       "order_lc":null,
 *       "date_order_lc":"2018-11-12",
 *       "article_lc":null,
 *       "code_spec_spo_lc":null,
 *       "code_spo_lc":null,
 *       "spec_vo_lc":null,
 *       "code_vo_lc":null,
 *       "accept_employer_lc":null,
 *       "accept_employee_lc":null,
 *       "id_lc_wh":null,
 *       "value_fields_lc":"{a:b}",
 *       "owner_lc":null,
 *       "owner_pin_lc":null,
 *       "owner_region_lc":null,
 *       "owner_tin_lc":null,
 *       "date_of_contract_lc":null,
 *       "main_work_lc":null,
 *       "id_structure_lc":null,
 *       "id_company_lc":null,
 *       "date_end_lc":null,
 *       "date_start_lc":"2018-11-28"
 *     },
 * @OA\Property (
 *     format="int64",
 *     title="Идентификатор ТД",
 *     property="id_lc",
 *     description="id_lc",
 * ),
 * @OA\Property (
 *     format="int64",
 *     title="Уникальный идентификатор родительской записи",
 *     property="parent_id_lc",
 *     description="Родительская запись",
 * ),
 * @OA\Property (
 *     format="boolean",
 *     title="Признак актуальности ТД",
 *     property="active_lc",
 *     description="Признак актуальности ТД",
 * ),
 * @OA\Property (
 *     format="timestamp",
 *     title="Дата создания записи в БД",
 *     property="datetime_lc",
 *     description="Дата создания записи в БД",
 * ),
 * @OA\Property (
 *     format="int2",
 *     title="Типизация ТД",
 *     property="type_lc",
 *     description="Типизация ТД",
 * ),
 * @OA\Property (
 *     format="boolean",
 *     title="Направление записи ТД",
 *     property="direct_lc",
 *     description="Направление записи ТД",
 * ),
 * @OA\Property (
 *     format="int64",
 *     title="Редактируемая запись",
 *     property="edit_id_lc",
 *     description="Редактируемая запись",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Идентификатор ФЛ",
 *     property="pin_lc",
 *     description="Идентификатор ФЛ",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="ИНН ФЛ в ТД",
 *     property="tax_person_lc",
 *     description="ИНН ФЛ в ТД",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Паспорт",
 *     property="passport_lc",
 *     description="Паспорт",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Фамилия",
 *     property="family_person_lc",
 *     description="Фамилия",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Имя",
 *     property="name_person_lc",
 *     description="Имя",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Отчество",
 *     property="middlename_person_lc",
 *     description="Отчество",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Идентификатор ЮЛ (ИНН)",
 *     property="tin_lc",
 *     description="Идентификатор ЮЛ (ИНН)",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Наименование ЮЛ",
 *     property="name_company_lc",
 *     description="Наименование ЮЛ",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="ОКЭД в ТД",
 *     property="oked_lc",
 *     description="ОКЭД в ТД",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="СОАТО ЮЛ",
 *     property="regionent_lc",
 *     description="СОАТО ЮЛ",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Подразделение",
 *     property="name_structure_lc",
 *     description="Подразделение",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Должность",
 *     property="name_position_lc",
 *     description="Должность",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Код профессии, должности",
 *     property="code_prof_lc",
 *     description="Код профессии, должности",
 * ),
 * @OA\Property (
 *     format="int64",
 *     title="Уникальный идентификатор должности",
 *     property="id_position_lc",
 *     description="Уникальный идентификатор должности",
 * ),
 * @OA\Property (
 *     format="float",
 *     title="Зарплата",
 *     property="salary_lc",
 *     description="Зарплата",
 * ),
 * @OA\Property (
 *     format="boolean",
 *     title="Признак надбавка",
 *     property="flag_bonus_lc",
 *     description="Признак надбавка",
 * ),
 * @OA\Property (
 *     format="int2",
 *     title="Условия оплаты труда",
 *     property="term_salary_lc",
 *     description="Условия оплаты труда",
 * ),
 * @OA\Property (
 *     format="int2",
 *     title="Вид занятости ТД",
 *     property="type_emp_lc",
 *     description="Вид занятости ТД",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Код по НСКЗ",
 *     property="code_nskz_lc",
 *     description="Код по НСКЗ",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Приказ",
 *     property="order_lc",
 *     description="Приказ",
 * ),
 * @OA\Property (
 *     format="date",
 *     title="Дата приказа",
 *     property="date_order_lc",
 *     description="Дата приказа",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Статья",
 *     property="article_lc",
 *     description="Статья",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Учебная специальность СПО",
 *     property="code_spec_spo_lc",
 *     description="Учебная специальность СПО",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Код специальности СПО",
 *     property="code_spo_lc",
 *     description="Код специальности СПО",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Учебная специальность ВО",
 *     property="spec_vo_lc",
 *     description="Учебная специальность ВО",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Код специальности ВО",
 *     property="code_vo_lc",
 *     description="Код специальности ВО",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Подтверждение работодателя",
 *     property="accept_employer_lc",
 *     description="Подтверждение работодателя",
 * ),
 * @OA\Property (
 *     format="int64",
 *     title="Идентификатор записи в Хранилище",
 *     property="id_lc_wh",
 *     description="Идентификатор записи в Хранилище",
 * ),
 * @OA\Property (
 *     format="array",
 *     title="Значения полей ТД",
 *     property="value_fields_lc",
 *     description="Значения полей ТД",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Идентификатор пользователя, создавшего запись",
 *     property="owner_lc",
 *     description="Идентификатор пользователя, создавшего запись",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="ПИНФЛ пользователя, создавшего запись",
 *     property="owner_pin_lc",
 *     description="ПИНФЛ пользователя, создавшего запись",
 * ),
 * @OA\Property (
 *     format="boolean",
 *     title="СОАТО пользователя, создавшего запись",
 *     property="owner_region_lc",
 *     description="СОАТО пользователя, создавшего запись",
 * ),
 * @OA\Property (
 *     format="int64",
 *     title="ИНН компании, пользователя, создавшего запись",
 *     property="owner_tin_lc",
 *     description="ИНН компании, пользователя, создавшего запись",
 * ),
 * @OA\Property (
 *     format="date",
 *     title="Дата заключения ТД",
 *     property="date_of_contract_lc",
 *     description="Дата заключения ТД",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Признак основной работы",
 *     property="main_work_lc",
 *     description="Признак основной работы",
 * ),
 * @OA\Property (
 *     format="int64",
 *     title="Уникальный идентификатор структуры организации",
 *     property="id_structure_lc",
 *     description="Уникальный идентификатор структуры организации",
 * ),
 * @OA\Property (
 *     format="int64",
 *     title="Уникальный идентификатор организации",
 *     property="id_company_lc",
 *     description="Уникальный идентификатор организации",
 * ),
 * @OA\Property (
 *     format="date",
 *     title="Дата начала ТД",
 *     property="date_start_lc",
 *     description="Дата начала ТД",
 * ),
 * @OA\Property (
 *     format="date",
 *     title="Дата конца ТД",
 *     property="date_end_lc",
 *     description="Дата конца ТД",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Категория персонала",
 *     property="code_personal_category_lc",
 *     description="Категория персонала по кодп",
 * ),
 * @OA\Property (
 *     format="numeric",
 *     title="Ставка договора",
 *     property="rate_lc",
 *     description="Ставка договора",
 * ),
 * @OA\Property (
 *     format="boolean",
 *     title="Подтверждение со стороны сотрудника",
 *     property="approve_contract_employee_lc",
 *     description="Подтверждение со стороны сотрудника",
 * )
 * 
 * 
 * ),
 * @property int $id_lc Идентификатор ТД
 * @property float|null $parent_id_lc Родительская запись
 * @property bool|null $active_lc
 * @property int|null $datetime_lc Дата записи ТД
 * @property int|null $type_lc Типизация ТД
 * @property bool|null $direct_lc Направление записи ТД
 * @property float|null $edit_id_lc Редактируемая запись
 * @property string $pin_lc Идентификатор ФЛ
 * @property string|null $tax_person_lc
 * @property string|null $passport_lc
 * @property string $family_person_lc Фамилия
 * @property string $name_person_lc Имя
 * @property string|null $middlename_person_lc Отчество
 * @property string $tin_lc Идентификатор ЮЛ (ИНН)
 * @property string $name_company_lc Наименование ЮЛ
 * @property string $oked_lc
 * @property string $regionent_lc
 * @property string|null $name_structure_lc Подразделение
 * @property string|null $name_position_lc Должность
 * @property string|null $code_prof_lc
 * @property float|null $id_position_lc
 * @property string|null $salary_lc Зарплата
 * @property bool|null $flag_bonus_lc
 * @property int|null $term_salary_lc
 * @property int|null $type_emp_lc
 * @property string|null $code_nskz_lc
 * @property string|null $order_lc Приказ
 * @property mixed|null $date_order_lc Дата приказа
 * @property string|null $article_lc Статья
 * @property string|null $code_spec_spo_lc
 * @property string|null $code_spo_lc
 * @property string|null $code_spec_vo_lc
 * @property string|null $code_vo_lc
 * @property string|null $accept_employer_lc
 * @property string|null $accept_employee_lc
 * @property float|null $id_lc_wh
 * @property array|null $value_fields_lc
 * @property float|null $owner_lc идентификатор пользователя, создавшего запись
 * @property string|null $owner_pin_lc ПИНФЛ пользователя, создавшего запись
 * @property string|null $owner_region_lc СОАТО пользователя, создавшего запись
 * @property string|null $owner_tin_lc ИНН компании, пользователя, создавшего запись
 * @property mixed|null $date_of_contract_lc
 * @property bool|null $main_work_lc
 * @property float|null $id_structure_lc
 * @property float|null $id_company_lc
 * @property mixed|null $date_end_lc
 * @property mixed|null $date_start_lc
 * @property string|null $code_prof_type_lc
 * @property string|null $code_personal_category_lc
 * @property bool|null $approve_contract_employee_lc
 * @property mixed|null $rate_lc
 * @property bool|null $gender_lc
 * @property int|null $phone_number_lc
 * @property-read \App\Models\v1\LcWh $LcWh
 * @property-read \App\Models\v1\Positions|null $Positions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereAcceptEmployeeLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereAcceptEmployerLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereActiveLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereApproveContractEmployeeLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereArticleLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereCodeNskzLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereCodePersonalCategoryLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereCodeProfLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereCodeProfTypeLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereCodeSpecSpoLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereCodeSpecVoLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereCodeSpoLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereCodeVoLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereDateEndLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereDateOfContractLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereDateOrderLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereDateStartLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereDatetimeLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereDirectLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereEditIdLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereFamilyPersonLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereFlagBonusLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereGenderLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereIdCompanyLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereIdLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereIdLcWh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereIdPositionLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereIdStructureLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereMainWorkLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereMiddlenamePersonLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereNameCompanyLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereNamePersonLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereNamePositionLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereNameStructureLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereOkedLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereOrderLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereOwnerLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereOwnerPinLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereOwnerRegionLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereOwnerTinLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereParentIdLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc wherePassportLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc wherePhoneNumberLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc wherePinLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereRateLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereRegionentLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereSalaryLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereTaxPersonLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereTermSalaryLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereTinLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereTypeEmpLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereTypeLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Lc whereValueFieldsLc($value)
 * @mixin \Eloquent
 */
class Lc extends Model
{


    /**
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @var string
     */
    public $table = 'lc';

    /**
     * @var string
     */
    protected $primaryKey = 'id_lc';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    public $fillable = [
        'parent_id_lc',
        'active_lc',
        'type_lc',
        'direct_lc',
        'edit_id_lc',
        'pin_lc',
        'tax_person_lc',
        'passport_lc',
        'family_person_lc',
        'name_person_lc',
        'middlename_person_lc',
        'tin_lc',
        'name_company_lc',
        'oked_lc',
        'regionent_lc',
        'name_structure_lc',
        'name_position_lc',
        'code_prof_lc',
        'id_position_lc',
        'salary_lc',
        'flag_bonus_lc',
        'term_salary_lc',
        'type_emp_lc',
        'code_nskz_lc',
        'order_lc',
        'date_order_lc',
        'article_lc',
        'code_spec_spo_lc',
        'code_spo_lc',
        'spec_vo_lc',
        'code_vo_lc',
        'accept_employer_lc',
        'accept_employee_lc',
        'id_lc_wh',
        'value_fields_lc',
        'owner_pin_lc',
        'owner_region_lc',
        'owner_tin_lc',
        'main_work_lc',
        'owner_lc',
        'date_of_contract_lc',
        'id_structure_lc',
        'id_company_lc',
        'date_start_lc',
        'date_end_lc',
        'code_personal_category_lc',
        'code_prof_type_lc',
        'rate_lc',
        'gender_lc',
        'phone_number_lc',
        'approve_contract_employee_lc'

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'parent_id_lc' => 'float',
        'active_lc' => 'boolean',
        'datetime_lc' => 'timestamp',
        'type_lc' => 'integer',
        'direct_lc' => 'boolean',
        'edit_id_lc' => 'float',
        'pin_lc' => 'string',
        'tax_person_lc' => 'string',
        'passport_lc' => 'string',
        'family_person_lc' => 'string',
        'name_person_lc' => 'string',
        'middlename_person_lc' => 'string',
        'tin_lc' => 'string',
        'name_company_lc' => 'string',
        'oked_lc' => 'string',
        'regionent_lc' => 'string',
        'name_structure_lc' => 'string',
        'name_position_lc' => 'string',
        'code_prof_lc' => 'string',
        'id_position_lc' => 'float',
        'salary_lc' => 'string',
        'flag_bonus_lc' => 'boolean',
        'term_salary_lc' => 'integer',
        'type_emp_lc' => 'integer',
        'code_nskz_lc' => 'string',
        'order_lc' => 'string',
        'date_order_lc' => 'date:Y-m-d',
        'article_lc' => 'string',
        'code_spec_spo_lc' => 'string',
        'code_spo_lc' => 'string',
        'code_spec_vo_lc' => 'string',
        'code_vo_lc' => 'string',
        'code_personal_category_lc' => 'string',
        'code_prof_type_lc' => 'string',
        'accept_employer_lc' => 'string',
        'accept_employee_lc' => 'string',
        'approve_contract_employee_lc' => 'boolean',
        'id_lc_wh' => 'float',
        'value_fields_lc' => 'array',
        'owner_pin_lc' => 'string',
        'owner_region_lc' => 'string',
        'owner_tin_lc' => 'string',
        'main_work_lc' => 'boolean',
        'owner_lc' => 'float',
        'date_of_contract_lc' => 'date:Y-m-d',
        'id_structure_lc' => 'float',
        'id_company_lc' => 'float',
        'date_start_lc' => 'date:Y-m-d',
        'date_end_lc' => 'date:Y-m-d',
        'rate_lc' => 'decimal:2',
        'gender_lc' => 'boolean',
        'phone_number_lc' => 'integer',
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
        'approve_contract_employee_lc' => false,
        'rate_lc' => 1.00,
    ];

    /**
     *
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new LcDefaultOrderByScope());

    }

    /**
     * @return string
     */
    public function getDateFormat()
    {
        return 'Y-m-d H:i:s.u';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     **/
    public function Positions()
    {
        return $this->belongsTo(\App\Models\v1\Positions::class, 'id_position_lc', 'id_position');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     **/
    public function LcWh()
    {
        return $this->hasOne(\App\Models\v1\LcWh::class, 'id_lc', 'id_lc');
    }

//    public function Vacancy()
//    {
//        return $this->hasManyThrough(
//            \App\Models\v1\Vacancy::class,
//            \App\Models\v1\Position::class,
//            'id_position_lc', // Foreign key on users table...
//            'id_vacancy_position', // Foreign key on posts table...
//            'id_vacancy', // Local key on countries table...
//            'id_position' // Local key on users table...
//        );
//    }


}
