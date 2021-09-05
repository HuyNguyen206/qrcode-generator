<?php

namespace Database\Factories;

use App\Models\Qrcode;
use Illuminate\Database\Eloquent\Factories\Factory;

class QrcodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Qrcode::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->word,
        'website' => $this->faker->word,
        'product_name' => $this->faker->word,
        'product_url' => $this->faker->word,
        'company_name' => $this->faker->word,
        'callback_url' => $this->faker->word,
        'qrcode_path' => $this->faker->word,
        'amount' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
