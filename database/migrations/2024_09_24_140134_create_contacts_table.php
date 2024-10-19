<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->id('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->text('description')->nullable();
			$table->string('email', 255);
			$table->string('title', 255);
			$table->integer('type')->nullable()->default('0');
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}
