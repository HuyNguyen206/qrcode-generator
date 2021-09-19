<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\User;
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
        'balance' => $this->faker->numberBetween(200, 4000),
        'total_credit' => $this->faker->numberBetween(50, 4000),
        'total_debit' => $this->faker->numberBetween(0, 200),
        'withdrawal_method' => $this->faker->randomElement(['bank', 'paypal', 'stripe', 'paystack']),
        'payment_email' => $this->faker->email,
        'bank_name' => $this->faker->word,
        'bank_branch' => $this->faker->state,
        'bank_account' => $this->faker->bankAccountNumber,
        'applied_for_payout' => $this->faker->boolean(50),
        'paid' => $this->faker->boolean(50),
        'country' => $this->faker->country,
        'last_date_applied' => $this->faker->date('Y-m-d'),
        'last_date_paid' => $this->faker->date('Y-m-d'),
        'other_details' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
