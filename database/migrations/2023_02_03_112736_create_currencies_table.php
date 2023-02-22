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
        Schema::create('currencies', function (Blueprint $table) {
            $table->string('cipher', 3)->primary();
            $table->string('code', 3);
            $table->string('name');
            $table->float('course', 8, 4)->unsigned()->nullable();
            $table->integer('remainder')->default(0)->unsigned();
            $table->timestamps();
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
        Schema::dropIfExists('remainder_days');
        Schema::dropIfExists('currencies');
    }
};
