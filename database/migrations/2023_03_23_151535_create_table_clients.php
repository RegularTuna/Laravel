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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->string('address');
            $table->string('postal-code',10);
            $table->string('locality');
            $table->string('country_id',2);
            $table->foreign('country_id')->references('id')->on('countries');
            $table->string('email',50);
            $table->string('telephone',20);
            $table->integer('vat_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_clients');
    }
};
