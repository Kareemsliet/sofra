<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->text('name');
		});
	}

	public function down()
	{
		Schema::drop('categories');
	}
}
