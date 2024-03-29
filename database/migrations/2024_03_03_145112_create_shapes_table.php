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
        /*Khi chay migrations ban se update cac truong du lieu trong database
        * Day la noi sua database ma ko can vao mysql
        * Cau lenh migrations: php artisan migrate
        * */
        Schema::create('shapes', function (Blueprint $table) {
            $table->id();
            $table->string('SName');
            $table->integer('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shapes');
    }
};
