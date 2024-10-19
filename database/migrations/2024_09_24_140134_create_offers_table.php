<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('name', 255);
			$table->text('description')->nullable();
			$table->string('image', 255)->nullable();
			$table->timestamp('from')->nullable();
			$table->timestamp('to')->nullable();
            $table->integer('discount')->nullable();
			$table->bigInteger('restaurant_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}
