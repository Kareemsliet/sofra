<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('restaurant_categories', function(Blueprint $table) {
			$table->id('id');
			$table->timestamps();
			$table->bigInteger('restaurant_id')->unsigned();
			$table->bigInteger('category_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('restaurant_categories');
	}
}
