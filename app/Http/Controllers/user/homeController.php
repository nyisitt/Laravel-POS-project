<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use App\Models\cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class homeController extends Controller
{
    //home page
    public function homePage(){
        $pizza = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }
    // filter category
    public function filter($categoryId){

    $pizza =Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
    $category = Category::get();
    $cart = cart::where('user_id',Auth::user()->id)->get();
    $history = Order::where('user_id',Auth::user()->id)->get();
    return view('user.main.home',compact('pizza','category','cart','history'));

    }
    // password change page
    public function passwordChange(){
        return view('user.account.password');
    }
    public function Change(Request $request){
        $this->passwordValidationCheck($request);
        $oldPassword=User::select('password')->where('id',Auth::user()->id)->first();
           $oldPassword=$oldPassword->password;

          if(Hash::check($request->oldPassword , $oldPassword )){
            $data = ['password'=>Hash::make($request->newPassword)];
            User::where('id',Auth::user()->id)->update($data);
            // Auth::logout();
            return back()->with(['change'=>'password change is successful']);

          }
          return back()->with(['notChange'=>'the old password is not same. Try Again!'] );
    }
    // account Edit
    public function edit(){
        return view('user.account.accountEdit');
    }
    // account Update
    public function update(Request $request,$id){
        $this->dataValidation($request);
        $data= $this->getData($request);
        // image
            if($request->hasFile('image')){
                $oldName = User::where('id',$id)->select('image')->first();
                $oldName = $oldName->image;
                Storage::delete('public/'.$oldName);

                $fileName = uniqid().'_'.$request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public',$fileName);
                $data['image']=$fileName;


            }

        User::where('id',$id)->update($data);
            return  back()->with(['update'=>'Account Update is success']);

    }
    // Pizza Detail
    public function detailPage($id){
        $pizza = Product::where('id',$id)->first();
        $pizzaList =Product::get();
        // dd($pizza);
        return view('user.main.detail',compact('pizza','pizzaList'));
    }

    // Cart List
    public function cartList(){
        $cart = cart::select('carts.*','products.name as pizzaName','products.price as pizzaPrice','products.image')
                    ->leftJoin('products','carts.product_id','products.id')
                    ->where('carts.user_id',Auth::user()->id)->get();

                    $totalPrice = 0;
                    foreach($cart as $c){
                        $totalPrice += $c->pizzaPrice * $c->qty;
                    }
        //  dd($cart->toArray());
        // dd($totalPrice);
        return view('user.cart.cartList',compact('cart','totalPrice'));
    }
    //  Cart History
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(3);

        return view('user.cart.history',compact('order'));
    }

    // ---------------------private function------------------------
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6',
            'newPassword'=>'required|min:6',
            'confrimPassword'=>'required|min:6|same:newPassword'
        ])->validate();
    }
     // Push Data
     private function getData($request){
        return[
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'updated_at'=>Carbon::now()
        ];
    }
    // Data validation
    private function dataValidation($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'gender'=>'required',
            'image'=>'mimes:jpg,jpeg,png,webp|file'
        ])->validate();
    }

}
