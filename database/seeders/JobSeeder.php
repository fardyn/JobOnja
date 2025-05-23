<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobListing = include database_path("seeders/data/job_listing.php");
        $userIds = User::pluck('id')->toArray();

        foreach ($jobListing as &$job) {
            $job['user_id'] = $userIds[array_rand($userIds)];

            $job['created_at'] = now();
            $job['updated_at'] = now();
        }

        DB::table('job_listing')->insert($jobListing);
        echo 'jobs created successfully!';
    }
}
