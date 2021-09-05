<?php

namespace App\Repositories;

use App\Models\Qrcode;
use App\Repositories\BaseRepository;

/**
 * Class QrcodeRepository
 * @package App\Repositories
 * @version September 5, 2021, 3:53 am UTC
*/

class QrcodeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'website',
        'product_name',
        'product_url',
        'company_name',
        'callback_url',
        'qrcode_path',
        'amount'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Qrcode::class;
    }
}
