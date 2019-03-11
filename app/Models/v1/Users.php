<?php

namespace App\Models\v1;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Storage;

use App\Passport\HasApiTokens;

/**
 * Class User
 *
 * @package App\Models
 * @version November 2, 2018, 5:10 am UTC
 * @OA\Schema (
 *     title="Пользователи",
 *     description="Пользователи",
 *     required={
 *       "id_structure",
 *       "name_structure",
 *     },
 *     example={
 *          "id_user": 603,
 *          "active_user": null,
 *          "type_user": 2,
 *          "tax_person_user": "400000001",
 *          "pin_user": "10100000000002",
 *          "tin_company_user": "100000005",
 *          "is_admin_user": null,
 *          "mobile_user": "998971111111",
 *          "home_tel_user": "998712222222",
 *          "token_user": null,
 *          "company_right_user": null,
 *          "ws_right_user": null,
 *          "visible_data_user": null,
 *          "ml_right_user": null,
 *          "su_right_user": null,
 *          "soato_minlab_user": null,
 *          "email_user": null,
 *          "soato_company_user": null,
 *          "user_oked_user": null,
 *          "family_person_user": "Shukurov",
 *          "name_person_user": "Aziz",
 *          "middlename_person_user": "Azizovich",
 *          "data_user":
 *          {
 *          "address": "Hamid Olimjon 45",
 *          "sex": 1,
 *          "birth_date": "1995-04-20"
 *          },
 *          "residential_address_user": "Ташкент, Мирзо-Улугбекский район, улица Паркентская, дом 23а, квартира 153"
 *     },
 * @OA\Property (
 *     format="int64",
 *     title="Уникальный идентификатор пользователя",
 *     property="id_user",
 *     description="Уникальный идентификатор пользователя",
 * ),
 * @OA\Property (
 *     format="boolean",
 *     title="Активность пользователя",
 *     property="active_user",
 *     description="Активность пользователя",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="ИНН польхователя",
 *     property="tax_person_user",
 *     description="ИНН польхователя",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="ПИНФЛ пользователя",
 *     property="pin_user",
 *     description="ПИНФЛ пользователя",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="ИНН компании к которой привязан пользователь",
 *     property="tin_company_user",
 *     description="ИНН компании к которой привязан пользователь",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="СОАТО",
 *     property="soato_company_user",
 *     description="СОАТО",
 * ),
 * @OA\Property (
 *     format="boolean",
 *     title="Является ли человек админимтратором",
 *     property="is_admin_user",
 *     description="Является ли человек админимтратором",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Номер мобильного телефона",
 *     property="mobile_user",
 *     description="Номер мобильного телефона",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Номер городского телефона",
 *     property="home_tel_user",
 *     description="Номер городского телефона",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Общий классификатор экономической деятельности",
 *     property="user_oked_user",
 *     description="Общий классификатор экономической деятельности",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Токен пользователя",
 *     property="token_user",
 *     description="Токен пользователя",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="СОАТО сотрудника минЗТО",
 *     property="soato_minlab_user",
 *     description="СОАТО сотрудника минЗТО",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Фамилия пользователя",
 *     property="family_person_user",
 *     description="Фамилия пользователя",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Имя пользователя",
 *     property="name_person_user",
 *     description="Имя пользователя",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Отчество пользователя",
 *     property="middlename_person_user",
 *     description="Отчество пользователя",
 * ),
 * @OA\Property (
 *     format="array",
 *     title="Массив данных",
 *     property="data_user",
 *     description="Массив данных",
 * ),
 * @OA\Property (
 *     format="int64",
 *     title="Тип пользователя",
 *     property="type_user",
 *     description="Тип пользователя",
 * ),
 * @OA\Property (
 *     format="int2",
 *     title="Разрешил ли пользователь показывать свои данные",
 *     property="visible_data_user",
 *     description="Разрешил ли пользователь показывать свои данные",
 * ),
 * @OA\Property (
 *     format="int64",
 *     title="Права пользователя",
 *     property="ml_right_user",
 *     description="Права пользователя",
 * ),
 * @OA\Property (
 *     format="int64",
 *     title="Права суперпользователя",
 *     property="su_right_user",
 *     description="Права суперпользователя",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Email пользователя",
 *     property="email_user",
 *     description="Email пользователя",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Адрес проживания",
 *     property="residential_address_user",
 *     description="Адрес проживания",
 * )
 * 
 * )
 * @property int $id
 * @property bool|null $active
 * @property int|null $type
 * @property string|null $person_tin
 * @property string|null $person_pin
 * @property string|null $company_tin
 * @property int|null $mobile_phone
 * @property int|null $home_phone
 * @property int|null $company_right
 * @property int|null $ws_right
 * @property string|null $password
 * @property int|null $ml_right
 * @property int|null $su_right
 * @property int|null $minzto_soato_code
 * @property string|null $email
 * @property string|null $person_name Фамилия пользователя
 * @property string|null $person_surname Имя пользователя
 * @property string|null $person_patronymic Отчество пользователя
 * @property mixed|null $data
 * @property string|null $residential_address
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Passport\Client[] $clients
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|Users newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Users newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Users query()
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereCompanyRight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereCompanyTin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereHomePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereMinztoSoatoCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereMlRight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereMobilePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users wherePersonName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users wherePersonPatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users wherePersonPin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users wherePersonSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users wherePersonTin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereResidentialAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereSuRight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereWsRight($value)
 * @mixin \Eloquent
 * @property string $avatar_path
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Users whereAvatarPath($value)
 */
class Users extends Model implements AuthenticatableContract, AuthorizableContract
{
    use HasApiTokens, Authenticatable, Authorizable;

    /**
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @var string
     */
    public $table = 'users';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'id_user';

    /**
     * @var array
     */
    public $fillable = [
        'active_user',
        'type_user',
        'tax_person_user',
        'pin_user',
        'tin_company_user',
        'soato_company_user',
        'is_admin_user',
        'mobile_user',
        'token_user',
        'home_tel_user',
        'user_oked_user',
        'company_right_user',
        'ws_right_user',
        'password',
        'visible_data_user',
        'ml_right_user',
        'su_right_user',
        'soato_minlab_user',
        'family_person_user',
        'name_person_user',
        'middlename_person_user',
        'data_user',
        'email_user',
        'residential_address_user',
        'avatar_path',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'active_user' => 'boolean',
        'tax_person_user' => 'string',
        'pin_user' => 'string',
        'tin_company_user' => 'string',
        'soato_company_user' => 'string',
        'is_admin_user' => 'boolean',
        'mobile_user' => 'string',
        'home_tel_user' => 'string',
        'user_oked_user' => 'string',
        'token_user' => 'string',
        'soato_minlab_user' => 'string',
        'family_person_user' => 'string',
        'name_person_user' => 'string',
        'middlename_person_user' => 'string',
        'data_user' => 'array',
        'type_user' => 'integer',
        'visible_data_user' => 'integer',
        'ml_right_user' => 'integer',
        'su_right_user' => 'integer',
        'email_user' => 'string',
        'residential_address_user' => 'string',
        'avatar_path' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Default data
     *
     * @var array
     */
    protected $attributes = [
        'active_user' => false
    ];
    /**
     * @return string
     */
    public function getDateFormat()
    {
        return 'Y-m-d H:i:s.u';
    }

    /**
     * Получить полный путь аватарки.
     *
     * @return string
     */
    public function getAvatarPathAttribute($path)
    {
        return is_null($path) ? null : Storage::url($path);
    }

}
