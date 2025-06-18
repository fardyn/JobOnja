<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Arr;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testUser = User::where('email', 'test@test.com')->firstOrFail();

        // Get all Job ID
        $jobIds = Job::pluck('id')->toArray();

        // randomly select jobs to bookmark
        $RandomJobIds = array_rand($jobIds, 3);

        // attach to selected job as bookmark for test user

        foreach ($RandomJobIds as $jobId) {
            $testUser->bookmarkedJobs()->attach($jobIds[$jobId]);
        }

    }
}
