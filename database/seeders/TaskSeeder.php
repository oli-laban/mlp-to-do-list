<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the task seeder.
     *
     * @return void
     */
    public function run(): void
    {
        Task::factory(5)->create();
    }
}
