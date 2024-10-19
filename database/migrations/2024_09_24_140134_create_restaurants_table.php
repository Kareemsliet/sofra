<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('name', 255);
			$table->string('email', 255);
			$table->string('password', 255);
			$table->string('phone', 255);
			$table->bigInteger('region_id')->unsigned();
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
			$table->decimal('minimum_order', 8,2);
			$table->decimal('delivery_price', 8,2);
			$table->integer('statue')->nullable()->default('0');
			$table->string('image', 255);
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}
