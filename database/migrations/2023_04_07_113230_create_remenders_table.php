<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemendersTable extends Migration
{
    protected $dateFormat = 'm/d/Y H:i A';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remenders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained();
            $table->string('name');
            $table->string('desc');
            $table->string('date');
            $table->softDeletes();
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
        Schema::dropIfExists('remenders');
    }
}
