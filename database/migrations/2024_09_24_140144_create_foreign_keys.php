<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('regions', function(Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('restrict')->onUpdate('restrict');
		});
		Schema::table('clients', function(Blueprint $table) {
			$table->foreign('region_id')->references('id')->on('regions')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('restaurants', function(Blueprint $table) {
			$table->foreign('region_id')->references('id')->on('regions')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('restaurants_conections', function(Blueprint $table) {
			$table->foreign('restaurant_id')->references('id')->on('restaurants')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->foreign('restaurant_id')->references('id')->on('restaurants')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->foreign('offer_id')->references('id')->on('offers')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('ratings', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('ratings', function(Blueprint $table) {
			$table->foreign('restaurant_id')->references('id')->on('restaurants')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('carts', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('carts', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('payment_method_id')->references('id')->on('payments_methods')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('restaurant_id')->references('id')->on('restaurants')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('order_items', function(Blueprint $table) {
			$table->foreign('order_id')->references('id')->on('orders')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('offers', function(Blueprint $table) {
			$table->foreign('restaurant_id')->references('id')->on('restaurants')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('restaurant_categories', function(Blueprint $table) {
			$table->foreign('restaurant_id')->references('id')->on('restaurants')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('restaurant_categories', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('payments', function(Blueprint $table) {
			$table->foreign('restaurant_id')->references('id')->on('restaurants')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('regions', function(Blueprint $table) {
			$table->dropForeign('regions_city_id_foreign');
		});
		Schema::table('clients', function(Blueprint $table) {
			$table->dropForeign('clients_region_id_foreign');
		});
		Schema::table('restaurants', function(Blueprint $table) {
			$table->dropForeign('restaurants_region_id_foreign');
		});
		Schema::table('restaurants_conections', function(Blueprint $table) {
			$table->dropForeign('restaurants_conections_restaurant_id_foreign');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_restaurant_id_foreign');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_offer_id_foreign');
		});
		Schema::table('ratings', function(Blueprint $table) {
			$table->dropForeign('ratings_client_id_foreign');
		});
		Schema::table('ratings', function(Blueprint $table) {
			$table->dropForeign('ratings_restaurant_id_foreign');
		});
		Schema::table('carts', function(Blueprint $table) {
			$table->dropForeign('carts_product_id_foreign');
		});
		Schema::table('carts', function(Blueprint $table) {
			$table->dropForeign('carts_client_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_payment_method_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_client_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_restaurant_id_foreign');
		});
		Schema::table('order_items', function(Blueprint $table) {
			$table->dropForeign('order_items_order_id_foreign');
		});
		Schema::table('order_items', function(Blueprint $table) {
			$table->dropForeign('order_items_product_id_foreign');
		});
		Schema::table('offers', function(Blueprint $table) {
			$table->dropForeign('offers_restaurant_id_foreign');
		});
		Schema::table('restaurant_categories', function(Blueprint $table) {
			$table->dropForeign('restaurant_categories_restaurant_id_foreign');
		});
		Schema::table('restaurant_categories', function(Blueprint $table) {
			$table->dropForeign('restaurant_categories_category_id_foreign');
		});
		Schema::table('payments', function(Blueprint $table) {
			$table->dropForeign('payments_restaurant_id_foreign');
		});
	}
}
