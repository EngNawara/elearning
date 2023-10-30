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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->longText('description');
            $table->longText('summary')->nullable();
            $table->longText('requirement')->nullable();
            $table->integer('price');
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->string('duration')->nullable();
            $table->enum('status', ['enabled', 'disabled', 'ongoing', 'cancelled', 'completed'])->default('enabled');
            $table->string('image')->nullable();
            $table->enum('is_popular', ['on' , 'off'])->default('off');
            $table->timestamps();

            // foreign key

            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
             $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign(User::class, 'teacher_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
