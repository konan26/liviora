// database/migrations/YYYY_MM_DD_HHMMSS_create_reports_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->unsignedBigInteger('report_id')->primary()->autoIncrement();
            $table->unsignedBigInteger('user_id');
            $table->text('isi_laporan');
            $table->enum('status', ['pending', 'diverifikasi', 'ditolak'])->default('pending');
            $table->dateTime('tanggal_lapor')->useCurrent();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
}