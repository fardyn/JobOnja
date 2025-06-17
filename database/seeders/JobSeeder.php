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
        // Get Test User ID
        $testUserId = User::where('email', 'test@test.com')->value('id');

        // Get all user IDs
        $userIds = User::where('email', '!=', 'test@test.com')->pluck('id')->toArray();

        foreach ($jobListing as $index => &$job) {
            if ($index < 2) {
                //assign the first two listings to test user
                $job['user_id'] = $testUserId;
            } else {
                $job['user_id'] = $userIds[array_rand($userIds)];
            }

            $job['created_at'] = now();
            $job['updated_at'] = now();
        }

        DB::table('job_listing')->insert($jobListing);
        echo 'jobs created successfully!';
    }
}
