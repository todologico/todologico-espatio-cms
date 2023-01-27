<?php

namespace Database\Factories;

use App\Models\ccc_cont1;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;


class ccc_cont1Factory extends Factory
{
    
    protected $model = ccc_cont1::class;

    public function definition()
    {
        return [
            'ccc_cont1_name' => $this->faker->word(),
            'ccc_cont1_surname' => $this->faker->word(),
            'ccc_cont1_phone' => $this->faker->numberBetween(0, 100000000),
            'ccc_cont1_cellphone' => $this->faker->numberBetween(0, 100000000),
            'ccc_cont1_email' => $this->faker->email(),
            'ccc_cont1_company' => $this->faker->word(),
            'ccc_cont1_auxiliary1' => $this->faker->word(),
            'ccc_cont1_auxiliary2' => $this->faker->word(),
            'ccc_cont1_auxiliary3' => $this->faker->word(),
            'ccc_cont1_auxiliary4' => $this->faker->word(),
            'ccc_cont1_auxiliary5' => $this->faker->word(),
            'ccc_cont1_text1' => $this->faker->word(),
            'ccc_cont1_token' => Str::random(50),
        ];
    }
}