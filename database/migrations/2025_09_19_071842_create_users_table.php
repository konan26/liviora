// database/migrations/YYYY_MM_DD_HHMMSS_create_users_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->primary()->autoIncrement();
            $table->string('nama_lengkap', 100);
            $table->string('email', 100)->unique();
            $table->string('password_hash', 255);
            $table->string('no_hp', 15);
            $table->enum('role', ['admin', 'staff', 'customer']);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->dateTime('tanggal_daftar')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}