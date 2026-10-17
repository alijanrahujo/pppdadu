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
        Schema::table('website_submissions', function (Blueprint $table) {
            $table->string('status')->default('new')->after('submission_type')->index();
            $table->boolean('is_read')->default(false)->after('status')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_submissions', function (Blueprint $table) {
            $table->dropColumn(['status', 'is_read']);
        });
    }
};
