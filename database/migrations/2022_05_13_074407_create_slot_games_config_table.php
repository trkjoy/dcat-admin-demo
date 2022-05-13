<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlotGamesConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slot_games_config', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gid')->unique()->default('0')->comment('游戏id');
            $table->string('gname')->default('')->comment('游戏名称');
            $table->integer('sort')->default('0')->comment('排序id');
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
        Schema::dropIfExists('slot_games_config');
    }
}
