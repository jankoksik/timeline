<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class eventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Testowe Wydarzenie 1',
            'description' => 'Opis testowego wydarzenia 1',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-10-30'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-11-15'), 
            'user_id' =>  1,
            'type_id' => 1,
        ];
    }
}
