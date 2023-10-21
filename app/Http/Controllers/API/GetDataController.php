<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetDataController extends Controller
{
    //get all data
    public function getData(){
        $product = Product::get();
        $user = User::get();
        $order =Order::get();
        $data = [
            "product"=>$product,
            'user'=>$user,
            'order'=>$order

        ];
        $text = [
            'data'=> 'hello',
            'email'=>'nyinyi'
        ];

        return response()->json($product, 200);
    }

    // post method
    public function category(Request $request){

        $data = [
            'name'=>$request->name
        ];
        Category::create($data);
        $response = Category::get();
        return response()->json($response, 200);
    }

    public function contact(Request $request){
      Contact::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'message'=>$request->message
      ]);
        $response = Contact::get();
        return response()->json($response, 200 );
    }

    // Delete method
    public function categoryDelete(Request $request){
      $data = Category::where('id',$request->id)->first();

      if(isset($data)){
        Category::where('id',$request->id)->delete();
        return response()->json($data, 200);
      }
      return response()->json(["message"=>'There is no category record'], 200);
    }
    public function deleteget($id){
        $data = Category::where('id',$id)->first();

      if(isset($data)){
        Category::where('id',$id)->delete();
        return response()->json($data, 200);
      }
      return response()->json(["message"=>'There is no category record'], 200);
    }

    // Detail data
    public function categoryDetail(Request $request){
        $data = Category::where('id',$request->id)->first();
        if(isset($data)){
            return response()->json($data, 200);
        }
        return response()->json(['message'=>"There is no category record"], 500);
    }
    public function getcategoryDetail($id){
        $data = Category::where('id',$id)->first();
        if(isset($data)){
            return response()->json($data, 200);
        }
        return response()->json(['message'=>"There is no category record"], 500);
    }

    // Update Data
    public function categoryUpdate(Request $request){

        $data = Category::where('id',$request->id)->first();
        if(isset($data)){
            Category::where('id',$request->id)->update([
                'name'=>$request->category_name,
                'updated_at'=> Carbon::now()
            ]);
            $response =Category::where('id',$request->id)->first();

            return response()->json(['Status'=>'success','response'=>$response], 200);
        }
        return response()->json(['message'=>'There is no category record'], 200 );
    }
}
