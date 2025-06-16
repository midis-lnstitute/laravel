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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            // $table->string('time'); time в стринг
            $table->string('description');
            $table->foreignId('user_id')->constrained(); //->unique(); если надо только 1 заявку от пользователя
            $table->string('path_img')->nullable();
            $table->enum('status', ['Новая', 'Одобрена', 'Отменена']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
