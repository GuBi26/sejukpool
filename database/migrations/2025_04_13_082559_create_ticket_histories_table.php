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
        Schema::create('ticket_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // jika ada user login
            $table->unsignedBigInteger('ticket_id');
            $table->integer('jumlah');
            $table->timestamp('tanggal_pemesanan');
            $table->timestamps();
    
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users'); // jika ada auth
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_histories');
    }
};
