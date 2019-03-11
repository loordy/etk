<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Nskz
 *
 * @package App\Models
 * @version October 31, 2018, 9:45 am UTC
 * @OA\Schema (
 *     title="НСКЗ",
 *     description="НСКЗ",
 *     example={
 *      "_id_": "396",
 *      "code": "81",
 *      "name": "ОПЕРАТОРЫ ПРОМЫШЛЕННЫХ УСТАНОВОК",
 *      "_parent_id_": "395"
 *     },
 * @OA\Property (
 *     format="int32",
 *     title="Ключ",
 *     property="_id_",
 *     description="Порядковый номер записи в таблице",
 * ),
 * @OA\Property (
 *     format="int32",
 *     title="Код",
 *     property="code",
 *     description="Код",
 * ),
 * @OA\Property (
 *     format="string",
 *     title="Наименование",
 *     property="name",
 *     description="Наименование",
 * ),
 * @OA\Property (
 *     format="int32",
 *     title="Ключ родителя",
 *     property="_parent_id_",
 *     description="Номер родительской записи в таблице",
 * )
 * 
 * )
 * @property int|null $code
 * @property string|null $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Nskz newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Nskz newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Nskz query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Nskz whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\v1\Nskz whereName($value)
 * @mixin \Eloquent
 */
class Nskz extends Model
{

    /**
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @var string
     */
    public $table = 'nskzs';

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
        return $this->where('name', 'like', '%' . $text . '%')->limit(10)->get();
    }

//    public function searchUz($text){
//        return $this->where('name_uz','like','%'.$text.'%')->limit(20)->get();
//    }
}
