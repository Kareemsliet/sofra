<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsMethodsTable extends Migration {

	public function up()
	{
		Schema::create('payments_methods', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->text('name');
			$table->text('description')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('payments_methods');
	}
}
