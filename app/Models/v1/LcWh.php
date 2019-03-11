<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\whDefaultOrderByScope;
use Carbon\Carbon;


/**
 * Class wh
 *
 * @package App\Models
 * @version November 2, 2018, 5:11 am UTC
 * @OA\Schema (
 *     title="wh model",
 *     description="wh model",
 *     required={
 *     "datetime_wh",
 *     "type_wh",
 *     "pin_wh",
 *     "taxper_wh",
 *     "passport_wh",
 *     "familyperson_wh",
 *     "nameperson_wh",
 *     "midlenameperson_wh",
 *     "tin_wh",
 *     "name_wh",
 *     "oked_wh",
 *     "position_wh",
 *     "department_wh",
 *     "salary_wh"
 * },
 *     example={
 *      "id_wh": 1,
 *      "parent_id_wh": null,
 *      "active_wh": true,
 *      "datetime_wh": "2018-11-12 14:09:15.442736",
 *      "type_wh": 2,
 *      "direct_wh": false,
 *      "edit_id_wh": null,
 *      "pin_wh": "100000000001",
 *      "taxper_wh": "100000001",
 *      "passport_wh": "AA1000001",
 *      "familyperson_wh": "F1",
 *      "nameperson_wh": "N1",
 *      "midlenameperson_wh": null,
 *      "tin_wh": "100000002",
 *      "name_wh": "ORG2",
 *      "oked_wh": "10002",
 *      "regionent_wh": "170311    ",
 *      "department_wh": "ORG2",
 *      "position_wh": "POS1_1",
 *      "prof_wh": "1     ",
 *      "id_position": 1,
 *      "salary_wh": "1010000.00",
 *      "flagbonus_wh": null,
 *      "termsalaru_wh": 1,
 *      "typeemp_wh": 1,
 *      "codenskz_wh": null,
 *      "order_wh": null,
 *      "dateorder_wh": "2001-07-12",
 *      "article_wh": null,
 *      "specspo_wh": null,
 *      "codespo_ls": null,
 *      "specvo_ls": null,
 *      "codevo_ls": null,
 *      "acceptemployer_wh": null,
 *      "acceptemployee_wh": null,
 *      "warehouse_id": 1,
 *      "value_fields_wh": null,
 *      "owner_wh": null,
 *      "owner_pin_wh": null,
 *      "owner_region_wh": null,
 *      "owner_tin_wh": null
 *     },
 * @OA\Property (
 *     format="int64",
 *     title="id_wh",
 *     property="id_wh",
 *     description="id_wh",
 * ),
 * @OA\Property (
 *     format="int64",
 *     title="parent_id_wh",
 *     property="parent_id_wh",
 *     description="parent_id_wh",
 * ),
 * @OA\Property (
 *     format="boolean",
 *     title="active_wh",
 *     property="active_wh",
 *     description="active_wh",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="datetime_wh",
 *     property="datetime_wh",
 *     description="datetime_wh",
 * ),
 * @OA\Property (
 *     format="int2",
 *     title="type_wh",
 *     property="type_wh",
 *     description="type_wh",
 * ),
 * @OA\Property (
 *     format="boolean",
 *     title="direct_wh",
 *     property="direct_wh",
 *     description="direct_wh",
 * ),
 * @OA\Property (
 *     format="int64",
 *     title="edit_id_wh",
 *     property="edit_id_wh",
 *     description="edit_id_wh",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="pin_wh",
 *     property="pin_wh",
 *     description="pin_wh",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="taxper_wh",
 *     property="taxper_wh",
 *     description="taxper_wh",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="passport_wh",
 *     property="passport_wh",
 *     description="passport_wh",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="familyperson_wh",
 *     property="familyperson_wh",
 *     description="familyperson_wh",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="nameperson_wh",
 *     property="nameperson_wh",
 *     description="nameperson_wh",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="midlenameperson_wh",
 *     property="midlenameperson_wh",
 *     description="midlenameperson_wh",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="tin_wh",
 *     property="tin_wh",
 *     description="tin_wh",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="name_wh",
 *     property="name_wh",
 *     description="name_wh",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="oked_wh",
 *     property="oked_wh",
 *     description="oked_wh",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="regionent_wh",
 *     property="regionent_wh",
 *     description="regionent_wh",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="department_wh",
 *     property="department_wh",
 *     description="department_wh",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="position_wh",
 *     property="position_wh",
 *     description="position_wh",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="prof_wh",
 *     property="prof_wh",
 *     description="prof_wh",
 * ),
 * @OA\Property (
 *     format="int64",
 *     title="id_position",
 *     property="id_position",
 *     description="id_position",
 * ),
 * @OA\Property (
 *     format="float",
 *     title="salary_wh",
 *     property="salary_wh",
 *     description="salary_wh",
 * ),
 * @OA\Property (
 *     format="boolean",
 *     title="flagbonus_wh",
 *     property="flagbonus_wh",
 *     description="flagbonus_wh",
 * ),
 * @OA\Property (
 *     format="int2",
 *     title="termsalaru_wh",
 *     property="termsalaru_wh",
 *     description="termsalaru_wh",
 * ),
 * @OA\Property (
 *     format="int2",
 *     title="typeemp_wh",
 *     property="typeemp_wh",
 *     description="typeemp_wh",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="codenskz_wh",
 *     property="codenskz_wh",
 *     description="codenskz_wh",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="order_wh",
 *     property="order_wh",
 *     description="order_wh",
 * ),
 * @OA\Property (
 *     format="date",
 *     title="dateorder_wh",
 *     property="dateorder_wh",
 *     description="dateorder_wh",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="article_wh",
 *     property="article_wh",
 *     description="article_wh",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="specspo_wh",
 *     property="specspo_wh",
 *     description="specspo_wh",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="codespo_ls",
 *     property="codespo_ls",
 *     description="codespo_ls",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="specvo_ls",
 *     property="specvo_ls",
 *     description="specvo_ls",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="codevo_ls",
 *     property="codevo_ls",
 *     description="codevo_ls",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="acceptemployer_wh",
 *     property="acceptemployer_wh",
 *     description="acceptemployer_wh",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="acceptemployee_wh",
 *     property="acceptemployee_wh",
 *     description="acceptemployee_wh",
 * ),
 * @OA\Property (
 *     format="int64",
 *     title="warehouse_id",
 *     property="warehouse_id",
 *     description="warehouse_id",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="value_fields_wh",
 *     property="value_fields_wh",
 *     description="value_fields_wh",
 * ),
 * 
 * 
 * ),
 * @property float $id_lc_wh
 * @property float|null $parent_id_lc
 * @property bool|null $active_lc
 * @property int $datetime_lc
 * @property int $type_lc
 * @property bool $direct_lc
 * @property float|null $edit_id_lc
 * @property string $pin_lc
 * @property string|null $tax_person_lc
 * @property string|null $passport_lc
 * @property string $family_person_lc
 * @property string $name_person_lc
 * @property string|null $middlename_person_lc
 * @property string $tin_lc
 * @property string $name_company_lc
 * @property string $oked_lc
 * @property string $regionent_lc
 * @property string|null $name_structure_lc
 * @property string|null $name_position_lc
 * @property string|null $code_prof_lc
 * @property float|null $id_position_lc
 * @property string|null $salary_lc
 * @property bool|null $flag_bonus_lc
 * @property int|null $term_salary_lc
 * @property int|null $type_emp_lc
 * @property string|null $code_nskz_lc
 * @property string|null $order_lc
 * @property \Illuminate\Support\Carbon|null $date_order_lc
 * @property string|null $article_lc
 * @property string|null $code_spec_spo_lc
 * @property string|null $code_spo_lc
 * @property string|null $code_spec_vo_lc
 * @property string|null $code_vo_lc
 * @property string|null $accept_employer_lc
 * @property string|null $accept_employee_lc
 * @property int|null $id_lc
 * @property array|null $value_fields_lc
 * @property float|null $owner_lc
 * @property string|null $owner_pin_lc
 * @property string|null $owner_region_lc
 * @property string|null $owner_tin_lc
 * @property \Illuminate\Support\Carbon|null $date_of_contract_lc
 * @property bool|null $main_work_lc
 * @property float|null $id_structure_lc
 * @property float|null $id_company_lc
 * @property \Illuminate\Support\Carbon|null $date_start_lc
 * @property \Illuminate\Support\Carbon|null $date_end_lc
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereAcceptEmployeeLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereAcceptEmployerLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereActiveLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereArticleLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereCodeNskzLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereCodeProfLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereCodeSpecSpoLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereCodeSpecVoLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereCodeSpoLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereCodeVoLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereDateEndLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereDateOfContractLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereDateOrderLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereDateStartLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereDatetimeLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereDirectLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereEditIdLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereFamilyPersonLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereFlagBonusLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereIdCompanyLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereIdLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereIdLcWh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereIdPositionLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereIdStructureLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereMainWorkLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereMiddlenamePersonLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereNameCompanyLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereNamePersonLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereNamePositionLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereNameStructureLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereOkedLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereOrderLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereOwnerLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereOwnerPinLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereOwnerRegionLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereOwnerTinLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereParentIdLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh wherePassportLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh wherePinLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereRegionentLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereSalaryLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereTaxPersonLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereTermSalaryLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereTinLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereTypeEmpLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereTypeLc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\LcWh whereValueFieldsLc($value)
 * @mixin \Eloquent
 */
class LcWh extends Model
{

    /**
     * @property float id_wh
     * @property float parent_id_wh
     * @property boolean active_wh
     * @property string| \Carbon\Carbon datetime_wh
     * @property integer type_wh
     * @property boolean direct_wh
     * @property float edit_id_wh
     * @property string pin_wh
     * @property string taxper_wh
     * @property string passport_wh
     * @property string familyperson_wh
     * @property string nameperson_wh
     * @property string midlenameperson_wh
     * @property string tin_wh
     * @property string name_wh
     * @property string oked_wh
     * @property string regionent_wh
     * @property string department_wh
     * @property string position_wh
     * @property string prof_wh
     * @property float id_position
     * @property decimal salary_wh
     * @property boolean flagbonus_wh
     * @property integer termsalaru_wh
     * @property integer typeemp_wh
     * @property string codenskz_wh
     * @property string order_wh
     * @property date dateorder_wh
     * @property string article_wh
     * @property string specspo_wh
     * @property string codespo_ls
     * @property string specvo_ls
     * @property string codevo_ls
     * @property string acceptemployer_wh
     * @property string acceptemployee_wh
     * @property float warehouse_id
     * @property string value_fields_wh
     */

    protected $connection = 'pgsql';

    /**
     * @var string
     */
    public $table = 'lc_wh';

    /**
     * @var string
     */
    protected $primaryKey = 'id_lc_wh';

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
        'date_end_lc'
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
        'date_order_lc' => 'date',
        'article_lc' => 'string',
        'code_spec_spo_lc' => 'string',
        'code_spo_lc' => 'string',
        'spec_vo_lc' => 'string',
        'code_vo_lc' => 'string',
        'accept_employer_lc' => 'string',
        'accept_employee_lc' => 'string',
        'id_lc_wh' => 'float',
        'value_fields_lc' => 'array',
        'owner_pin_lc' => 'string',
        'owner_region_lc' => 'string',
        'owner_tin_lc' => 'string',
        'main_work_lc' => 'boolean',
        'owner_lc' => 'float',
        'date_of_contract_lc' => 'date',
        'id_structure_lc' => 'float',
        'id_company_lc' => 'float',
        'date_start_lc' => 'date',
        'date_end_lc' => 'date'
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
