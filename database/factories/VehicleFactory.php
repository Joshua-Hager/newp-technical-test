<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'make'  => $this->pickValue(['Toyota', 'Honda', 'GMC', 'Ford', 'Nissan', 'Hyundai', 'BMW', 'Mercedes']),
            'model' => $this->pickValue(['Mid Size Truck', 'Full Size Truck', 'Cargo Van', 'Sedan', 'Coupe', 'SUV']),
            'color' => $this->pickValue(['White', 'Red', 'Blue', 'Black', 'Gold', 'Green', 'Grey']),
            'year'  => $this->pickValue([2010, 2011, 2013, 2014, 2015, 2016, 2017, 2018, 2019, 2020]),
        ];
    }

    /**
     * Pick a value at random from a given array
     * Taken from https://www.php.net/manual/en/function.array-rand.php#93834
     *
     * @param array $array
     * @return mixed
     */
    private function pickValue(array $array)
    {
        return array_rand(array_flip($array), 1);
    }
}
