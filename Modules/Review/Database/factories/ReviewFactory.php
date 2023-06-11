<?php

namespace Modules\Review\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Review\Entities\Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment' => fake()->comment(),
            'rating' => fake()->unique()->safeEmail(),
            'client_id' =>  function () {
                return Modules\Client\Entities\Client::all()->random()->id;
            },
            'coach_id' =>  function () {
                return Modules\Coach\Entities\Coach::all()->random()->id;
            },
            'service_id' =>  function () {
                return Modules\Service\Entities\Service::all()->random()->id;
            },
        ];
    }
}

