<?php

namespace Database\Factories;

use App\Models\Section;
use App\Models\Appointment;

use function Laravel\Prompts\password;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'email'=>fake()->safeEmail(),
            'email_verified_at'=>now(),
            'password'=>123456,
            'phone'=>fake()->phoneNumber(),
            'section_id'=>Section::all()->random()->id,
            // 'appointments'=>Appointment::all()->random()->name

        ];
    }
}
