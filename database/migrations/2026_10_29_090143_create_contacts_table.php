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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 150);
            $table->string('cnic_number', 30);
            $table->string('email_address', 255)->nullable();
            $table->string('phone_number', 50)->nullable();
            $table->string('contact_type', 50)->default('General inquiry');
            $table->text('message');
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
        Schema::dropIfExists('contacts');
    }
};
