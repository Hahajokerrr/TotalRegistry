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
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->tinyText('series_name');
            $table->tinyText('brand');
            $table->date('produced_at');
            $table->foreignId('country_id')->constrained('countries');
            $table->mediumInteger('length');
            $table->mediumInteger('widht');
            $table->mediumInteger('height');
            $table->mediumInteger('weight');
            $table->mediumInteger('payload');
            $table->tinyInteger('seat');
            $table->mediumInteger('output');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
