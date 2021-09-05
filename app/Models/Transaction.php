<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Transaction
 * @package App\Models
 * @version September 5, 2021, 3:55 am UTC
 *
 * @property integer $user_id
 * @property integer $qrcode_id
 * @property string $payment_method
 * @property integer $qrcode_owner_id
 * @property string $message
 * @property number $amount
 * @property string $status
 */
class Transaction extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'transactions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'qrcode_id',
        'payment_method',
        'qrcode_owner_id',
        'message',
        'amount',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'qrcode_id' => 'integer',
        'payment_method' => 'string',
        'qrcode_owner_id' => 'integer',
        'message' => 'string',
        'amount' => 'float',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'qrcode_id' => 'required',
        'payment_method' => 'nullable|string|max:255',
        'qrcode_owner_id' => 'nullable',
        'message' => 'nullable|string',
        'amount' => 'required|numeric',
        'status' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
