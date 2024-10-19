<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCartsTable extends Migration {

	public function up()
	{
		Schema::create('carts', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->bigInteger('product_id')->unsigned();
			$table->integer('quantity')->default(1);
			$table->text('description')->nullable();
			$table->bigInteger('client_id')->unsigned();
			$table->decimal('price', 8,2);
		});
	}

	public function down()
	{
		Schema::drop('carts');
	}
}
