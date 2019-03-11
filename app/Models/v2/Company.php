<?php

namespace App\Models\v2;



/**
 * App\Models\v2\Company
 *
 * @property string $tin
 * @property string $name
 * @property string $soato_code
 * @property array $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $oked
 * @property-read \Illuminate\Database\Eloquent\Collection|Position[] $Positions
 * @property-read Soato $Soato
 * @property-read \Illuminate\Database\Eloquent\Collection|Structure[] $Structures
 * @property-read \Illuminate\Database\Eloquent\Collection|Transaction[] $Transactions
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $Users
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereOked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereSoatoCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereTin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 * @mixin BaseModel
 */
class Company extends BaseModel
{

    /**
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @var string
     */
    public $table = 'companies';


    /**
     * @var string
     */
    protected $primaryKey = 'tin';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    public $fillable = [
        'tin',
        'name',
        'oked',
        'soato_code',
        'data',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'tin' => 'string',
        'name' => 'string',
        'oked' => 'string',
        'soato_code' => 'string',
        'data' => 'array',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/

    public function Structures()
    {
        return $this->hasMany(Structure::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function Transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function Positions()
    {
        return $this->hasMany(Position::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function Users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     **/
    public function Soato()
    {
        return $this->belongsTo(Soato::class);
    }


}
