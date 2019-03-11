<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

/**
 * App\User
 *
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCompanyRight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCompanyTin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereHomePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereMinztoSoatoCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereMlRight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereMobilePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePersonName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePersonPatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePersonPin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePersonSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePersonTin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereResidentialAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSuRight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereWsRight($value)
 * @mixin \Eloquent
 * @property string|null $avatar_path
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAvatarPath($value)
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
