<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Report>
 */
class ReportFactory extends Factory
{
    // Centro aproximado de San Miguel, El Salvador: 13.4833, -88.1833
    public function definition(): array
    {
        return [
            'user_id'       => User::factory(),
            'category_id'   => Category::factory(),
            'latitude'      => 13.4833 + fake()->randomFloat(6, -0.027, 0.027),
            'longitude'     => -88.1833 + fake()->randomFloat(6, -0.027, 0.027),
            'description'   => fake()->sentence(12),
            'photo_path'    => null,
            'status'        => 'pending',
            'votes_confirm' => 0,
            'votes_resolve' => 0,
        ];
    }

    public function verified(): static
    {
        return $this->state(fn () => [
            'status'            => 'verified',
            'status_changed_at' => now(),
            'verified_at'       => now(),
        ]);
    }

    public function resolved(): static
    {
        return $this->state(fn () => [
            'status'            => 'resolved',
            'status_changed_at' => now(),
            'verified_at'       => now()->subDay(),
            'resolved_at'       => now(),
        ]);
    }

    // Coordenadas dentro del campus UES FMO, San Miguel (~500m de radio)
    public function fmo(): static
    {
        return $this->state(fn () => [
            'latitude'  => 13.4925 + fake()->randomFloat(6, -0.004, 0.004),
            'longitude' => -88.1680 + fake()->randomFloat(6, -0.004, 0.004),
        ]);
    }

    // Coordenadas aleatorias por todo El Salvador (excluyendo San Miguel)
    public function elsalvador(): static
    {
        return $this->state(function () {
            do {
                $lat = fake()->randomFloat(6, 13.15, 14.45);
                $lng = fake()->randomFloat(6, -90.12, -87.68);
            } while ($lat >= 13.45 && $lat <= 13.52 && $lng >= -88.22 && $lng <= -88.15);

            return ['latitude' => $lat, 'longitude' => $lng];
        });
    }
}
