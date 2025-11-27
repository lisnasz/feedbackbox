<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            $table->string('status')->default('baru')->after('ip_address');
            $table->longText('admin_response')->nullable()->after('message');
            $table->unsignedBigInteger('category_id')->nullable()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            $table->dropColumn(['status', 'admin_response', 'category_id']);
        });
    }
};
