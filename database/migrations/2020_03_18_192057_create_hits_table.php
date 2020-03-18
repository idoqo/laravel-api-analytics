<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHitsTable extends Migration
{
    public function up()
    {
        Schema::create('hits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('url');
            $table->string('params')->default(null);
            $table->string('request_ip');
            $table->string('response_code');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hits');
    }
}
