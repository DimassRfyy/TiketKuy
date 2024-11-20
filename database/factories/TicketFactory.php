<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\City;
use App\Models\Ticket;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'thumbnail' => $this->faker->word(),
            'video_url' => $this->faker->word(),
            'about' => $this->faker->text(),
            'address' => $this->faker->text(),
            'price' => $this->faker->randomNumber(),
            'category_id' => Category::factory(),
            'city_id' => City::factory(),
            'opened_at' => $this->faker->time(),
            'closed_at' => $this->faker->time(),
            'is_popular' => $this->faker->boolean(),
        ];
    }
}
