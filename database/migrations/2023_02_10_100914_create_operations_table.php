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
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('currency_cipher', '3');
            $table->string('currency_cipher_donor')->nullable();
            $table->float('course', 8, 4)->nullable();
            $table->float('sum', 12)->nullable();
            $table->float('sum_donor', 12)->nullable();
            $table->string('comment')->nullable();
            $table->dateTimeTz('date');

            $table->foreign('currency_cipher')->references('cipher')
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
        Schema::dropIfExists('operations');
    }
};
