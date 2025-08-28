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
    Schema::create('memberships', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Plan name
        $table->decimal('price', 8, 2); // Price
        $table->integer('duration_days'); // Plan duration in days
        $table->integer('borrow_limit'); // Max books user can borrow
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
