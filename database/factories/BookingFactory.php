<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Booking;
use App\Models\Ticket;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->word(),
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'ticket_id' => Ticket::factory(),
            'total_participant' => $this->faker->randomNumber(),
            'booking_date' => $this->faker->date(),
            'price' => $this->faker->randomNumber(),
            'total' => $this->faker->randomNumber(),
            'status' => $this->faker->word(),
            'payment_method' => $this->faker->word(),
            'payment_proof' => $this->faker->word(),
        ];
    }
}
