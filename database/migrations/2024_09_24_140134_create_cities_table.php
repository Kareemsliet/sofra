<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCitiesTable extends Migration {

	public function up()
	{
		Schema::create('cities', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->text('name');
		});
	}

	public function down()
	{
		Schema::drop('cities');
	}
}
