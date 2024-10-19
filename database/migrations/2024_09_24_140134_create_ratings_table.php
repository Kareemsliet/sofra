<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRatingsTable extends Migration {

	public function up()
	{
		Schema::create('ratings', function(Blueprint $table) {
			$table->timestamps();
			$table->id();
			$table->bigInteger('client_id')->unsigned();
			$table->integer('rate');
			$table->text('comment')->nullable();
			$table->bigInteger('restaurant_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('ratings');
	}
}
