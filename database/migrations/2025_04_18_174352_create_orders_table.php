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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('ticket_id')->constrained()->onDelete('cascade');
        $table->date('tanggal_kunjungan');
        $table->integer('jumlah');
        $table->bigInteger('total_harga');
        $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending');
        $table->string('snap_token', 255)->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
