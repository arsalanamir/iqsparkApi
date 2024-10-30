<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUniqueConstraintFromEmail extends Migration
{
    public function up()
    {
        Schema::table('user_attempts', function (Blueprint $table) {
            $table->string('email')->unique(false)->change();
        });
    }

    public function down()
    {
        Schema::table('user_attempts', function (Blueprint $table) {
            $table->string('email')->unique()->change();
        });
    }
}

