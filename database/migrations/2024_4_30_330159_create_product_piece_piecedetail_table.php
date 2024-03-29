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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('ProName');
            $table->integer('ProPrice');
            $table->string('ProImage');
            $table->string('ProDescription');
            $table->foreignId('CategoryID')->constrained('categories')->onDelete('cascade');
            $table->integer('ProStock');
            $table->integer('created_by');
            $table->timestamps();
        });

        Schema::create('piece', function (Blueprint $table) {
            $table->id();
            $table->string('PName');
            $table->string('PImage');
            $table->foreignId('ShapeID')->constrained('shapes')->onDelete('cascade');
            $table->foreignId('ColorID')->constrained('colors')->onDelete('cascade');
            $table->foreignId('SizeID')->constrained('sizes')->onDelete('cascade');
            $table->integer('InStock');
            $table->integer('created_by');
            $table->timestamps();
        });

        Schema::create('pieceDetail', function (Blueprint $table) {
            // Define foreign key constraints
            $table->foreignId('ProductID')->constrained('product')->onDelete('cascade');
            $table->foreignId('PieceID')->constrained('piece')->onDelete('cascade');

            // Define other columns
            $table->integer('StockUse');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
