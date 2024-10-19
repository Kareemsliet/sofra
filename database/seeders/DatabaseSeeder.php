<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Region;
use App\Models\RestauranConection;
use App\Models\Restaurant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //  City::create([
        //     'name'=>"لمنصورة"
        //  ]);

        //   Region::create([
        //     'name'=>"حي الجلاؤ بحوار سوبر ماركت العدل",
        //     'city_id'=>1
        //   ]);

        //   Category::created([
        //     'name'=>"وجبات",
        //   ]);

        // Category::create([
        //     'name'=>"سندوشات",
        // ]);

        // PaymentMethod::create([
        //     'name'=>"كاش"
        // ]);

        // DB::insert("insert into permissions (name,guard_name,created_at,updated_at,routes) values ('طرق الدفع','web',NOW(),NOW(),'payment-methods.index'),('الدوفعات','web',NOW(),NOW(),'payments,index')");

        // User::create([
        //     'email'=>"kareem@gmail.com",
        //     'password'=>Hash::make("05915491"),
        //     'name'=>"كريم",
        // ]);

        // $restaurant=Restaurant::find(6);

        // $restaurant->update([
        //     'statue'=>1,
        // ]);

        
    }
}

