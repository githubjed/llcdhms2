<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('user_role',50)->default(0);
            $table->string('user_type',50);
            $table->string('user_status',50)->default('Active');
            $table->string('password')->default('$2y$10$Zh8flN71iVDaKfUc5idqbOWoEAZSodbY8BcnkMnGkDNwulP/5oZNa');
             $table->string('avatar')->default('default.png');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

