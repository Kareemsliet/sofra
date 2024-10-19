<?php
use App\Models\Category;
use App\Models\City;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Region;
use App\Models\Restaurant;
use App\Models\Setting;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
function responseJson($statue,$message=null,$data=null){
    $responses=[
        'status'=>$statue,
        'message'=>$message,
        'data'=>$data,
    ];
    return response()->json($responses,200);
}

function sections(){
    $sections=[];

        $sections['cities']['count']=City::count('id');
        $sections['cities']['name']="المدن";
        $sections['cities']['icon']="globe";
        $sections['cities']['pages']['add']['route']="cities.create";
        $sections['cities']['pages']['add']['permission']="اضافة مدينة";
        $sections['cities']['pages']['index']['route']="cities.index";
        $sections['cities']['pages']['index']['permission']="المدن";

        $sections['regions']['count']=Region::count('id');
        $sections['regions']['name']="المناطق";
        $sections['regions']['icon']="globe";
        $sections['regions']['pages']['add']['route']="regions.create";
        $sections['regions']['pages']['add']['permission']="اضافة منطقة";
        $sections['regions']['pages']['index']['route']="regions.index";
        $sections['regions']['pages']['index']['permission']="المناطق";

        $sections['roles']['count']=Role::count('id');
        $sections['roles']['name']="القواعد";
        $sections['roles']['icon']="globe";
        $sections['roles']['pages']['add']['route']="roles.create";
        $sections['roles']['pages']['add']['permission']="اضافة قاعدة";
        $sections['roles']['pages']['index']['route']="roles.index";
        $sections['roles']['pages']['index']['permission']="القواعد";

        $sections['categories']['count']=Category::count('id');
        $sections['categories']['name']="الاقسام";
        $sections['categories']['icon']="globe";
        $sections['categories']['pages']['add']['route']="categories.create";
        $sections['categories']['pages']['add']['permission']="اضافة قسم";
        $sections['categories']['pages']['index']['route']="categories.index";
        $sections['categories']['pages']['index']['permission']="الاقسام";

        $sections['payment_methods']['count']=PaymentMethod::count('id');
        $sections['payment_methods']['name']="طرق الدفع";
        $sections['payment_methods']['icon']="credit-card";
        $sections['payment_methods']['pages']['add']['route']="payment-methods.create";
        $sections['payment_methods']['pages']['add']['permission']="اضافة طريقة الدفع";
        $sections['payment_methods']['pages']['index']['route']="payment-methods.index";
        $permission=Permission::where('name',"=","طرق الدفع")->first();
        $sections['payment_methods']['pages']['index']['permission']=$permission;

        $sections['payments']['count']=Payment::count('id');
        $sections['payments']['name']="الدفعات";
        $sections['payments']['icon']="dollar";
        $sections['payments']['pages']['add']['route']="payments.create";
        $permission_add=Permission::where('name',"اضافة عملية دفع")->first();
        $sections['payments']['pages']['add']['permission']=$permission_add;
        $sections['payments']['pages']['index']['route']="payments.index";
        $permission=Permission::where("name","الدوفعات")->first();
        $sections['payments']['pages']['index']['permission']=$permission;

        $sections['clients']['count']=Client::count('id');
        $sections['clients']['name']="العملاء";
        $sections['clients']['icon']="users";
        $sections['clients']['pages']['index']['route']="clients.index";
        $sections['clients']['pages']['index']['permission']="العملاء";

        $sections['restaurants']['count']=Restaurant::count('id');
        $sections['restaurants']['name']="المطاعم";
        $sections['restaurants']['icon']="building";
        $sections['restaurants']['pages']['index']['route']="restaurants.index";
        $sections['restaurants']['pages']['index']['permission']="المطاعم";

        $sections['contacts']['count']=Contact::count('id');
        $sections['contacts']['name']="التواصلات";
        $sections['contacts']['icon']="server";
        $sections['contacts']['pages']['index']['route']="contacts.index";
        $sections['contacts']['pages']['index']['permission']="التواصلات";

        $sections['orders']['count']=Order::count('id');
        $sections['orders']['name']="الطلبات";
        $sections['orders']['icon']="apple";
        $sections['orders']['pages']['index']['route']="orders.index";
        $sections['orders']['pages']['index']['permission']="الطلبات";

        $sections['users']['count']=City::count('id');
        $sections['users']['name']="المستخدمين";
        $sections['users']['icon']="users";
        $sections['users']['pages']['add']['route']="users.create";
        $sections['users']['pages']['add']['permission']="اضافة مستخدم";
        $sections['users']['pages']['index']['route']="users.index";

        $sections['users']['pages']['index']['permission']="المستخدمين";

        return $sections;
}

function setting(){
    $setting=Setting::first();
    return $setting;
}
