<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('issued_books', function (Blueprint $table) {
        $table->date('issued_date')->nullable();
        $table->date('return_date')->nullable();
    });
}

public function down()
{
    Schema::table('issued_books', function (Blueprint $table) {
        $table->dropColumn(['issued_date', 'return_date']);
    });
}

};
