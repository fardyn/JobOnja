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
            $table->enum('job_type', ['full-time', 'part-time', 'contract', 'temporary', 'intern', 'on-call', 'volunteer']);
            $table->boolean('remote')->default(false);
            $table->text('requirement')->nullable();
            $table->text('benefits')->nullable();
            $table->string('city');
            $table->string('address');
            $table->string('zipcode')->nullable();
            $table->string('contact_name');
            $table->string('contact_phone')->nullable();
            $table->string('company_name');
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
            $table->dropForeign('user_id');
            $table->dropColumn('user_id');
            $table->dropColumn('salary',
                'tags',
                'job_type',
                'remote',
                'requirement',
                'benefits',
                'city',
                'address',
                'zipcode',
                'contact_name',
                'contact_phone',
                'company_name',
                'company_description',
                'company_logo',
                'company_website');
        });
    }
};
