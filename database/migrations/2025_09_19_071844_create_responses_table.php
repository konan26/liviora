// database/migrations/YYYY_MM_DD_HHMMSS_create_responses_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsesTable extends Migration
{
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->unsignedBigInteger('response_id')->primary()->autoIncrement();
            $table->unsignedBigInteger('report_id');
            $table->unsignedBigInteger('user_id');
            $table->text('isi_tanggapan');
            $table->dateTime('tanggal_reply')->useCurrent();
            $table->timestamps();

            $table->foreign('report_id')->references('report_id')->on('reports')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('responses');
    }
}