<?php

namespace Database\Factories;

use App\Models\EventCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id = $this->faker->numberBetween(1, 1000000);
        $title = $this->faker->sentence;
        $slug = Str::slug($title);
        $content = array_map(function () {
            return [
                'type' => $this->faker->randomElement(['heading', 'paragraph']),
                'data' => [
                    'id' => $this->faker->numberBetween(1, 1000000),
                    'content' => $this->faker->paragraph,
                ],
            ];
        }, range(1, $this->faker->numberBetween(1, 5)));
        $today = now();
        $random_days = rand(1, 25); // Генерируем случайное число дней от 1 до 365
        $event_date_start = date('Y-m-d', strtotime($today->format('Y-m-d') . ' +' . $random_days . ' days'));
        $event_time_start = $this->faker->time('H:i');
        $address = $this->faker->address;
        $is_online = $this->faker->randomElement([true, false]);
        $category_id = EventCategory::inRandomOrder()->first();
        $created_at = now();
        $updated_at = now();

        return [
            'id' => $id,
            'title' => $title,
            'slug' => $slug,
            'content' => $content,
            'event_date_start' => $event_date_start,
            'event_time_start' => $event_time_start,
            'address' => $address,
            'is_online' => $is_online,
            'category_id' => $category_id,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];

    }
}
