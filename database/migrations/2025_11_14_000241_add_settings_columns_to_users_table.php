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
        Schema::table('users', function (Blueprint $table) {
            $table->text('bio')->nullable()->after('role');
            $table->string('username')->nullable()->after('bio');
            $table->string('timezone')->nullable()->after('username');
            $table->string('language', 10)->default('en')->after('timezone');
            $table->boolean('email_notifications')->default(true)->after('language');
            $table->boolean('push_notifications')->default(true)->after('email_notifications');
            $table->boolean('sms_notifications')->default(false)->after('push_notifications');
            $table->string('theme')->default('auto')->after('sms_notifications');
            $table->string('layout')->default('sidebar')->after('theme');
            $table->string('font_size')->default('normal')->after('layout');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'bio',
                'username',
                'timezone',
                'language',
                'email_notifications',
                'push_notifications',
                'sms_notifications',
                'theme',
                'layout',
                'font_size'
            ]);
        });
    }
};
