<?php

namespace App\Repositories;

use App\Models\AccountHistory;
use App\Repositories\BaseRepository;

/**
 * Class AccountHistoryRepository
 * @package App\Repositories
 * @version September 12, 2021, 2:32 am UTC
*/

class AccountHistoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'account_id',
        'user_id',
        'message'
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
        return AccountHistory::class;
    }
}
