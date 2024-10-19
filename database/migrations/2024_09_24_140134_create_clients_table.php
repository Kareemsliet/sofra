<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('name', 255);
			$table->string('phone', 255);
			$table->string('email', 255);
			$table->string('password', 255);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
			$table->bigInteger('region_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
