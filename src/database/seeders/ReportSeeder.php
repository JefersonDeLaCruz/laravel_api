<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $users      = User::all();
        $categories = Category::all();

        // 150 reportes en San Miguel y zona FMO
        Report::factory(110)->recycle($users)->recycle($categories)->create();
        Report::factory(25)->verified()->recycle($users)->recycle($categories)->create();
        Report::factory(15)->resolved()->recycle($users)->recycle($categories)->create();

        // 50 reportes en campus UES FMO
        Report::factory(35)->fmo()->recycle($users)->recycle($categories)->create();
        Report::factory(10)->fmo()->verified()->recycle($users)->recycle($categories)->create();
        Report::factory(5)->fmo()->resolved()->recycle($users)->recycle($categories)->create();
    }
}
