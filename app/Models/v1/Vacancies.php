<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Vacancy
 *
 * @property int $id_vacancy
 * @property string $tin_company_vacancy
 * @property string $region_vacancy
 * @property string|null $oked_vacancy
 * @property string $name_company_vacancy
 * @property string $name_structure_vacancy
 * @property string $name_position_vacancy
 * @property string $code_prof_vacancy
 * @property int $salary_vacancy
 * @property string|null $request_vacancy
 * @property float|null $id_position_vacancy
 * @property string $region4_vacancy
 * @property string|null $date_start_vacancy
 * @property string|null $date_end_vacancy
 * @property string|null $code_prof_type_vacancy
 * @property-read \App\Models\v2\Company $Companies
 * @property-read \App\Models\v1\Positions|null $Positions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\v2\Structure[] $Structures
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Vacancies newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Vacancies newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Vacancies query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Vacancies whereCodeProfTypeVacancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Vacancies whereCodeProfVacancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Vacancies whereDateEndVacancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Vacancies whereDateStartVacancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Vacancies whereIdPositionVacancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Vacancies whereIdVacancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Vacancies whereNameCompanyVacancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Vacancies whereNamePositionVacancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Vacancies whereNameStructureVacancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Vacancies whereOkedVacancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Vacancies whereRegion4Vacancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Vacancies whereRegionVacancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Vacancies whereRequestVacancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Vacancies whereSalaryVacancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Vacancies whereTinCompanyVacancy($value)
 * @mixin \Eloquent
 */
class Vacancies extends Model
{

    /**
     * @var string
     */
    public $table = 'vacancies';

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
    protected $primaryKey = 'id_vacancy';

    /**
     * @var array
     */
    public $fillable = [
        'tin_company_vacancy',
        'region_vacancy',
        'oked_vacancy',
        'name_company_vacancy',
        'name_structure_vacancy',
        'name_position_vacancy',
        'code_prof_vacancy',
        'salary_vacancy',
        'request_vacancy',
        'id_position_vacancy',
        'region4_vacancy',
        'date_end_vacancy',
        'date_start_vacancy'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'tin_company_vacancy' => 'string',
        'region_vacancy' => 'string',
        'oked_vacancy' => 'string',
        'name_company_vacancy' => 'string',
        'name_structure_vacancy' => 'string',
        'name_position_vacancy' => 'string',
        'code_prof_vacancy' => 'string',
        'salary_vacancy' => 'integer',
        'request_vacancy' => 'string',
        'region4_vacancy' => 'string',
        'date_start_vacancy' => 'string',
        'id_position_vacancy' => 'float',
        'date_end_vacancy' => 'string'
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     **/
    public function Positions()
    {
        return $this->belongsTo(\App\Models\v1\Positions::class, 'id_position_vacancy', 'id_position');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Companies()
    {
        return $this->belongsTo(\App\Models\v2\Company::class, 'tin_company_vacancy', 'tin_company');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasManyThrough
     */
    public function Structures()
    {
        return $this->hasManyThrough(
            \App\Models\v2\Structure::class,
            \App\Models\v1\Positions::class,
            'id_position',
            'id',
            'id_position_vacancy',
            'id_structure_position')->limit(1);
    }


}
