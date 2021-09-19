<?php

namespace Database\Factories;

use App\Models\Qrcode;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

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
            'user_id' => User::all()->random(),
        'website' => $this->faker->url,
        'product_name' => $this->faker->word,
        'product_url' => $this->faker->url,
        'company_name' => $this->faker->name,
        'callback_url' => $this->faker->url,
        'qrcode_path' => Storage::url('qrcodes/'),
        'amount' => rand(100, 4000),
            'status' => rand(0,1),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
