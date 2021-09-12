<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Account
 * @package App\Models
 * @version September 12, 2021, 2:53 am UTC
 *
 * @property integer $user_id
 * @property number $balance
 * @property number $total_credit
 * @property number $total_debit
 * @property string $withdrawal_method
 * @property string $payment_email
 * @property string $bank_name
 * @property string $bank_branch
 * @property string $bank_account
 * @property boolean $applied_for_payout
 * @property boolean $paid
 * @property string $country
 * @property string $last_date_applied
 * @property string $last_date_paid
 * @property string $other_details
 */
class Account extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'accounts';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at', 'last_date_paid', 'last_date_applied'];



    public $fillable = [
        'user_id',
        'balance',
        'total_credit',
        'total_debit',
        'withdrawal_method',
        'payment_email',
        'bank_name',
        'bank_branch',
        'bank_account',
        'applied_for_payout',
        'paid',
        'country',
        'last_date_applied',
        'last_date_paid',
        'other_details'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'balance' => 'float',
        'total_credit' => 'float',
        'total_debit' => 'float',
        'withdrawal_method' => 'string',
        'payment_email' => 'string',
        'bank_name' => 'string',
        'bank_branch' => 'string',
        'bank_account' => 'string',
        'applied_for_payout' => 'boolean',
        'paid' => 'boolean',
        'country' => 'string',
        'last_date_applied' => 'date',
        'last_date_paid' => 'date',
        'other_details' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'balance' => 'required|numeric',
        'total_credit' => 'required|numeric',
        'total_debit' => 'required|numeric',
        'withdrawal_method' => 'required|string|max:255',
        'payment_email' => 'nullable|string|max:255',
        'bank_name' => 'nullable|string|max:255',
        'bank_branch' => 'nullable|string|max:255',
        'bank_account' => 'nullable|string|max:255',
        'applied_for_payout' => 'required|boolean',
        'paid' => 'required|boolean',
        'country' => 'nullable|string|max:255',
        'last_date_applied' => 'nullable',
        'last_date_paid' => 'nullable',
        'other_details' => 'nullable|string',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function accountHistories()
    {
        return $this->hasMany(AccountHistory::class);
    }


}
