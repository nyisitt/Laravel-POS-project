<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //order list page
    public function orderListPage(){
        $order = Order::select('orders.*','users.name as user_name')
                            ->leftJoin('users','orders.user_id','users.id')
                            ->orderBy('created_at','desc')
                            ->get();
                            //  dd($orderList->toArray());
        return view('admin.order.list',compact('order'));
    }
    //  status section
    public function status(Request $request){
        // dd($request->all());
        $order = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','orders.user_id','users.id')
                ->orderBy('created_at','desc');


             if($request->orderStatus == null){
                $order = $order->get();
             }else{
                $order = $order->where('orders.status',$request->orderStatus)->get();
             }


              return view('admin.order.list',compact('order'));
    }
    // Change Status
    public function changeStatus(Request $request){
        // logger($request->all());
        Order::where("id",$request->orderId)->update([
            'status'=>$request->value
        ]);


    }
    // Order product list
    public function codeList($orderCode){
        $order = Order::where('order_code',$orderCode)->first();
        $orderList = OrderList::select("order_lists.*",'users.name as user_name','products.name as product_name','products.image as product_image')
                                ->leftJoin('users','users.id','order_lists.user_id')
                                ->leftJoin('products','products.id','order_lists.product_id')
                                ->where('order_lists.order_code',$orderCode)->get();
                                // dd($orderList->toArray());
        return view('admin.order.productList',compact('orderList','order'));

    }
}
