<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('description', 255)->nullable();
			$table->bigInteger('payment_method_id')->unsigned();
			$table->bigInteger('client_id')->unsigned();
			$table->decimal('total', 8,2)->nullable()->default(0.0);
			$table->decimal('commission', 8,2)->nullable()->default(0.0);
			$table->integer('statue')->nullable()->default('0');
            $table->decimal('delivery_cost',8,2)->nullable()->default(0.0);
            $table->decimal('cost',8,2)->nullable()->default(0.0);
            $table->decimal('net')->default(0.0)->nullable();
			$table->bigInteger('restaurant_id')->unsigned()->nullable();
        });
	}
	public function down()
	{
		Schema::drop('orders');
	}
}
