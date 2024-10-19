<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingTable extends Migration {

	public function up()
	{
		Schema::create('setting', function(Blueprint $table) {
			$table->id('id');
			$table->timestamps();
			$table->text('name');
            $table->decimal('commission')->nullable();
			$table->string('logo', 255);
			$table->string('hero_image', 255)->nullable();
			$table->text('description')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('setting');
	}
}
