<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Employee;
class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     *    $table->string('position')
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            Employee::create([
                'name' => $faker->name,
                'tenant_id' => $faker->randomNumber([1, 2]),
                'email' => $faker->email,
                'position' => $faker->jobTitle,
                'department' => $faker->word,
                'salary' => $faker->numberBetween(30000, 100000),
                'joining_date' => $faker->date,
            ]);
        }
        
    }
}
