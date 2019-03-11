<?php

namespace App\Models\v2;



/**
 * App\Models\v2\ApproveCode
 *
 * @property int $id
 * @property float $phone_number
 * @property float $transaction_id
 * @property string $code
 * @property float $user_id
 * @property float|null $approved_user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User|null $ApprovedUser
 * @property-read Transaction $Transaction
 * @property-read User $User
 * @method static \Illuminate\Database\Eloquent\Builder|ApproveCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApproveCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApproveCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|ApproveCode whereApprovedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApproveCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApproveCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApproveCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApproveCode whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApproveCode wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApproveCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApproveCode whereUserId($value)
 * @mixin BaseModel
 */
class ApproveCode extends BaseModel
{

    /**
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * @var string
     */
    public $table = 'approve_codes';


    /**
     * @var array
     */
    public $fillable = [
        'phone_number',
        'transaction_id',
        'code',
        'user_id',
        'approved_user_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'phone_number' => 'float',
        'transaction_id' => 'float',
        'code' => 'string',
        'user_id' => 'float',
        'approved_user_id' => 'float',
        'created_at' => 'date',
        'updated_at' => 'date',
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
        'code',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ApprovedUser()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

}
