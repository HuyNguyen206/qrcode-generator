<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\AccountHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AccountHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'account_id' => $account = Account::all()->random(),
        'user_id' => $account->user_id,
        'message' => $this->faker->paragraph(2),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
