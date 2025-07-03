<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('job_listing')->truncate();
        Schema::table('job_listing', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id');
            $table->integer('salary');
            $table->string('tags')->nullable();
            $table->enum('job_type', ['Part-Time', 'Full-Time', 'Contract', 'Temporary', 'Intern', 'On-call', 'Volunteer']);
            $table->boolean('remote')->default(false);
            $table->text('requirements')->nullable();
            $table->text('benefits')->nullable();
            $table->string('city');
            $table->string('address');
            $table->string('state');
            $table->string('zipcode')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email');
            $table->string('company_name');
            $table->string('company_address')->nullable();
            $table->text('company_description');
            $table->string('company_logo')->nullable();
            $table->string('company_website')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_listing', function (Blueprint $table) {
            // Correct way to drop foreign key by column name:
            $table->dropForeign(['user_id']);

            // Then drop columns - pass as array:
            $table->dropColumn([
                'user_id',
                'salary',
                'tags',
                'job_type',
                'remote',
                'requirements',       // note: your up() uses 'requirements' (plural), not 'requirement'
                'benefits',
                'city',
                'state',
                'address',
                'zipcode',
                'contact_name',
                'contact_phone',
                'contact_email',      // you forgot to drop this in your down()
                'company_name',
                'company_address',
                'company_description',
                'company_logo',
                'company_website'
            ]);
        });
    }
};
