<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $userClass = app(config('wallet.user_model', 'App\User'));

        Schema::create('wallets', function (Blueprint $table) use ($userClass) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();

            $table->bigInteger('balance')->default(0);

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
        Schema::dropIfExists('wallets');
    }
}
