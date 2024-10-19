<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	public function up()
	{
		Schema::create('payments', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->bigInteger('restaurant_id')->unsigned();
			$table->decimal('total', 8,2);
		});
	}

	public function down()
	{
		Schema::drop('payments');
	}
}
