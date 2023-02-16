<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('remainder_days', function (Blueprint $table) {
            $table->id();
            $table->string('cipher', 3);
            $table->integer('remainder');
            $table->date('date');

            $table->foreign('cipher')->references('cipher')
                ->on('currencies')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('remainder');
    }
};
