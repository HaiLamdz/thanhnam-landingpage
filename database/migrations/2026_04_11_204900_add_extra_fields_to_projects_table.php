<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('client')->nullable()->after('description');
            $table->string('location')->nullable()->after('client');
            $table->string('category')->nullable()->after('location');
            $table->string('services')->nullable()->after('category');
            $table->string('completion_status')->nullable()->default('Hoàn thành')->after('services');
            $table->longText('body')->nullable()->after('completion_status');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['client', 'location', 'category', 'services', 'completion_status', 'body']);
        });
    }
};
