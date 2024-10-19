<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegionsTable extends Migration {

	public function up()
	{
		Schema::create('regions', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->text('name');
			$table->bigInteger('city_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('regions');
	}
}
