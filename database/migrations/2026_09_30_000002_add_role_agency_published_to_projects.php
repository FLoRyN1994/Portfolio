<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('role')->default('Full-stack developer')->after('github_url');
            $table->foreignId('agency_id')->nullable()->constrained('agencies')->nullOnDelete()->after('role');
            $table->boolean('published')->default(false)->after('agency_id');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['agency_id']);
            $table->dropColumn(['role', 'agency_id', 'published']);
        });
    }
};
