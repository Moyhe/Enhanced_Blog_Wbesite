<?php

namespace Database\Factories;

use App\Models\TextWidget;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TextWidget>
 */
class TextWidgetFactory extends Factory
{

    protected $model = TextWidget::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => 'About-page',
            'image' => fake()->imageUrl(),
            'title' => 'About-page',
            'content' => fake()->paragraph(),
            'active' => true
        ];
    }
}
