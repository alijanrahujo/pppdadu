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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->string('member_type', 100)->nullable();
            $table->string('gender', 50)->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('email_address')->nullable()->index();
            $table->string('mobile_number', 50)->nullable()->index();
            $table->string('cnic_number', 30)->nullable()->index();
            $table->date('date_of_birth')->nullable();
            $table->string('education', 100)->nullable();
            $table->string('profession', 150)->nullable();
            $table->string('resident_type', 50)->default('Pakistani');
            $table->string('province', 100)->nullable();
            $table->string('division', 100)->nullable();
            $table->string('district', 100)->nullable()->index();
            $table->string('tehsil_city', 100)->nullable();
            $table->text('current_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->json('volunteering')->nullable();
            $table->string('status', 30)->default('new')->index();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
