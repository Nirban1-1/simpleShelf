<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'birthdate')) {
                $table->date('birthdate')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'nid')) {
                $table->string('nid')->nullable()->after('birthdate');
            }
            if (!Schema::hasColumn('users', 'location')) {
                $table->string('location')->nullable()->after('nid');
            }
            if (!Schema::hasColumn('users', 'photo')) {
                $table->string('photo')->nullable()->after('location');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['birthdate', 'nid', 'location', 'photo']);
        });
    }
};
