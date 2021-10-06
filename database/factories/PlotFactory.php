<?php

namespace Database\Factories;

use App\Models\Plot;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlotFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plot::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $createReestrNumber = [];
            for($i = 0;$i < 4;$i++) {
                $createReestrNumber[] = $this->faker->numberBetween($min=10, $max=99);
            }
            $number = implode(':', $createReestrNumber);
        return [
            'number' => $number,
            'address' => $this->faker->address,
            'cad_cost' => $this->faker->numberBetween($min = 10000, $max = 20000),
            'area_value' => $this->faker->numberBetween($min = 10000, $max = 20000),
        ];
    }
}
