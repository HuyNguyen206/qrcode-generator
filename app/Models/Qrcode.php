<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Qrcode
 * @package App\Models
 * @version September 5, 2021, 3:53 am UTC
 *
 * @property integer $user_id
 * @property string $website
 * @property string $product_name
 * @property string $product_url
 * @property string $company_name
 * @property string $callback_url
 * @property string $qrcode_path
 * @property number $amount
 */
class Qrcode extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'qrcodes';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'website',
        'product_name',
        'product_url',
        'company_name',
        'callback_url',
        'qrcode_path',
        'amount',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'website' => 'string',
        'product_name' => 'string',
        'product_url' => 'string',
        'company_name' => 'string',
        'callback_url' => 'string',
        'qrcode_path' => 'string',
        'amount' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'website' => 'nullable|string|max:255',
        'product_name' => 'required|string|max:255',
        'product_url' => 'nullable|string|max:255',
        'company_name' => 'required|string|max:255',
        'callback_url' => 'required|string|max:255',
        'qrcode_path' => 'nullable|string|max:255',
        'amount' => 'required|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }


}
