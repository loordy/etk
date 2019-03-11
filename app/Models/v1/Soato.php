<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Soato
 *
 * @package App\Models
 * @version October 31, 2018, 9:45 am UTC
 * @property int|null $code
 * @property string|null $name_ru
 * @property string|null $name_uz
 * @property string|null $admincenter_ru
 * @property string|null $admincenter_uz
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Soato newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Soato newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Soato query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Soato whereAdmincenterRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Soato whereAdmincenterUz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Soato whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Soato whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Soato whereNameUz($value)
 * @mixin \Eloquent
 */
class Soato extends Model
{
    /**
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @var string
     */
    public $table = 'soatos';

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
