<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use App\Models\cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return ajax data
    public function pizzaList(Request $request){
        // logger($request->status);
        if($request->status == 'asc'){
            $data =Product::orderBy('created_at','asc')->get();
        }else{
            $data =Product::orderBy('created_at','desc')->get();
        }

        return response()->json($data, 200);
    }
    // Pizza cart ajax
    public function pizzaCart(Request $request){
        // logger($request->all());
        $data = $this->getData($request);
       cart::create($data);
       $response =[
        'message'=>'Add to card complete',
        'status'=>'success'
       ];
       return response()->json($response, 200);
    }
    // Order list ajax
    public function orderList(Request $request){
         logger($request->all());
        $total = 0;
        foreach($request->all() as $item){
           $data = OrderList::create([
                'user_id' =>$item['userId'],
                'product_id'=>$item['productId'],
                'qty'=>$item['qty'],
                'total'=>$item['total'],
                'order_code'=>$item['orderCode']
            ]);
            $total += $data->total ;
        }

        // logger($deltotal);
        cart::where('user_id',Auth::user()->id)->delete();

         Order::create([
             'user_id'=> Auth::user()->id,
             'order_code'=> $data->order_code,
             'total_price'=> $total+3000
         ]);

      return response()->json([
        'status'=>'true',
        'message'=>'order complete'
      ], 200, );
    }

    // clear cart all
    public function clearAll(){
        cart::where('user_id',Auth::user()->id)->delete();
         return response()->json([
            'status' => 'true',
         ], 200,);
    }
    // clear cart item
    public function clearItem(Request $request){
        logger($request->all());
        cart::where('id',$request->cartId)  ->delete();


    }
    // view Count
    public function viewCount(Request $request){
        $product = Product::where('id',$request->productId)->first();
        $view =  $product->view_count+1;
        Product::where('id',$request->productId)->update([
            'view_count' => $view
        ]);
    }

//    ----------------------------------- private fucntion --------------------------------
private function getData($request){
    return [
        'user_id' => $request->userid,
        'product_id'=> $request->pizzaId,
        'qty' =>$request->count,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];
}
}
