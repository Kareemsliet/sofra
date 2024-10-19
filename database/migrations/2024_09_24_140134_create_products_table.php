<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('name', 255);
			$table->text('description')->nullable();
			$table->string('image', 255)->nullable();
			$table->decimal('price', 8,2);
			$table->integer('delivery_time');
			$table->bigInteger('restaurant_id')->unsigned();
			$table->bigInteger('offer_id')->unsigned()->nullable();
			$table->decimal('offer_price', 8,2)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}
