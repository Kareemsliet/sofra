<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderItemsTable extends Migration {

	public function up()
	{
		Schema::create('order_items', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
            $table->string('name');
            $table->bigInteger('order_id')->unsigned();
			$table->text('description')->nullable();
			$table->decimal('price');
			$table->integer('quantity');
		});
	}

	public function down()
	{
		Schema::drop('order_items');
	}
}
