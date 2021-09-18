<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->word,
        'balance' => $this->faker->randomDigitNotNull,
        'total_credit' => $this->faker->randomDigitNotNull,
        'total_debit' => $this->faker->randomDigitNotNull,
        'withdrawal_method' => $this->faker->word,
        'payment_email' => $this->faker->word,
        'bank_name' => $this->faker->word,
        'bank_branch' => $this->faker->word,
        'bank_account' => $this->faker->word,
        'applied_for_payout' => $this->faker->randomDigitNotNull,
        'paid' => $this->faker->randomDigitNotNull,
        'country' => $this->faker->word,
        'last_date_applied' => $this->faker->date('Y-m-d'),
        'last_date_paid' => $this->faker->date('Y-m-d'),
        'other_details' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
