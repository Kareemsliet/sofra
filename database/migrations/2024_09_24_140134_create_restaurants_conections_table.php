<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsConectionsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants_conections', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->bigInteger('restaurant_id')->unsigned();
			$table->string('phone', 255);
			$table->string('whatsapp', 255)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('restaurants_conections');
	}
}
