<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\EventType;
use App\Models\Event;
use Carbon\Carbon;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             'password' => Hash::make('Ky73|8w?MU9-BB['),
         ]);
         User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
            'password' => Hash::make('Z2x-4C7<3e}r,nY'),
        ]);

        EventType::factory()->create([
            'name' => 'ONLINE 🌐',
            'color' => '#66f8ff',
        ]);
        EventType::factory()->create([
            'name' => 'ONSITE 🏫',
            'color' => '#f54f6a',
        ]);
        EventType::factory()->create([
            'name' => 'HYBRID 🐱‍🚀',
            'color' => '#44e3a4',
        ]);
        Event::factory()->create([
            'name' => 'Testowe Wydarzenie 0',
            'description' => 'Baaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaardzo długi opis wydarzenia 0',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-10-25'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-15'), 
            'user_id' =>  1,
            'type_id' => 2,
        ]);

        Event::factory()->create([
            'name' => 'Testowe Wydarzenie 1',
            'description' => 'Opis testowego wydarzenia 1',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-10-30'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-11-15'), 
            'user_id' =>  1,
            'type_id' => 3,
        ]);
        Event::factory()->create([
            'name' => 'Testowe Wydarzenie 2',
            'description' => 'Opis testowego wydarzenia 2',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-10-25'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-11-16'), 
            'user_id' =>  1,
            'type_id' => 2,
        ]);
        Event::factory()->create([
            'name' => 'Testowe Wydarzenie 3',
            'description' => 'Opis testowego wydarzenia 3',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-11-01'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-11-05'), 
            'user_id' =>  1,
            'type_id' => 1,
        ]);
        Event::factory()->create([
            'name' => 'Testowe Wydarzenie 4',
            'description' => 'Opis testowego wydarzenia 4',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-11-03'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-11-09'), 
            'user_id' =>  1,
            'type_id' => 3,
        ]);
        Event::factory()->create([
            'name' => 'Testowe Wydarzenie 5',
            'description' => 'Opis testowego wydarzenia 5',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-11-07'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-11-12'), 
            'user_id' =>  1,
            'type_id' => 3,
        ]);
        Event::factory()->create([
            'name' => 'Testowe Wydarzenie 6',
            'description' => 'Opis testowego wydarzenia 6',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-11-17'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-29'), 
            'user_id' =>  1,
            'type_id' => 3,
        ]);
        Event::factory()->create([
            'name' => 'Testowe Wydarzenie 7',
            'description' => 'Opis testowego wydarzenia 7',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-11-07'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-11-11'), 
            'user_id' =>  1,
            'type_id' => 1,
        ]);
        Event::factory()->create([
            'name' => 'Testowe Wydarzenie 8',
            'description' => 'Opis testowego wydarzenia 8',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-07'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-12'), 
            'user_id' =>  1,
            'type_id' => 3,
        ]);
        Event::factory()->create([
            'name' => 'Testowe Wydarzenie 9',
            'description' => 'Opis testowego wydarzenia 9',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-04'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-18'), 
            'user_id' =>  2,
            'type_id' => 1,
        ]);
        Event::factory()->create([
            'name' => 'Testowe Wydarzenie 10',
            'description' => 'Opis testowego wydarzenia 10',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-11-13'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-14'), 
            'user_id' =>  1,
            'type_id' => 3,
        ]);
        Event::factory()->create([
            'name' => 'Testowe Wydarzenie 11',
            'description' => 'Opis testowego wydarzenia 11',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-07'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-14'), 
            'user_id' =>  1,
            'type_id' => 3,
        ]);
        Event::factory()->create([
            'name' => 'Testowe Wydarzenie 12',
            'description' => 'Opis testowego wydarzenia 12',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-02'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-12'), 
            'user_id' =>  2,
            'type_id' => 2,
        ]);
        Event::factory()->create([
            'name' => 'Testowe Wydarzenie 13',
            'description' => 'Opis testowego wydarzenia 13',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-01'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-12'), 
            'user_id' =>  2,
            'type_id' => 2,
        ]);

        Event::factory()->create([
            'name' => 'Testowe Wydarzenie 14',
            'description' => 'Opis testowego wydarzenia 14',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-03'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-06'), 
            'user_id' =>  2,
            'type_id' => 2,
        ]);
        Event::factory()->create([
            'name' => 'Testowe Wydarzenie 15',
            'description' => 'Opis testowego wydarzenia 15',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-02'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-18'), 
            'user_id' =>  2,
            'type_id' => 3,
        ]);
        Event::factory()->create([
            'name' => 'Testowe Wydarzenie 16',
            'description' => 'Opis testowego wydarzenia 16',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-04'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-07'), 
            'user_id' =>  2,
            'type_id' => 3,
        ]);
        Event::factory()->create([
            'name' => 'Testowe Wydarzenie 17',
            'description' => 'Opis testowego wydarzenia 17',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-02'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-09'), 
            'user_id' =>  2,
            'type_id' => 1,
        ]);
        Event::factory()->create([
            'name' => 'Testowe Wydarzenie 18',
            'description' => 'Opis testowego wydarzenia 18',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-05'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-21'), 
            'user_id' =>  2,
            'type_id' => 1,
        ]);
        Event::factory()->create([
            'name' => 'Testowe Wydarzenie 19',
            'description' => 'Opis testowego wydarzenia 19',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-03'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-12'), 
            'user_id' =>  2,
            'type_id' => 3,
        ]);
        Event::factory()->create([
            'name' => 'Testowe Wydarzenie 20',
            'description' => 'Opis testowego wydarzenia 20',
            'start_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-12'),
            'end_date' =>  Carbon::createFromFormat('Y-m-d', '2023-12-24'), 
            'user_id' =>  2,
            'type_id' => 1,
        ]);

    }
}
