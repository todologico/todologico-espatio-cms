<?php

namespace Database\Factories;

use App\Models\rxcp_cate1;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;


class rxcp_cate1Factory extends Factory
{
    
    protected $model = rxcp_cate1::class;

    public function definition()
    {
        return [
            'rxcp_cate1_category'   => $this->faker->word(),
            'rxcp_cate1_title1'     => $this->faker->word(),
            'rxcp_cate1_title2'     => $this->faker->word(),
            'rxcp_cate1_text1'      => $this->faker->word(),
            'rxcp_cate1_image1'     => $this->faker->word(),
            'rxcp_cate1_image2'     => $this->faker->word(),
            'rxcp_cate1_order'      => $this->faker->numberBetween(0, 100000000),
            'rxcp_cate1_enable'     => $this->faker->numberBetween(0, 1),
            'rxcp_cate1_token'      => Str::random(50),
        ];
    }
}