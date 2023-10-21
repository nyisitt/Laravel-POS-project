<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    //ProductLists Page
    public function productPage(){

       $pizza= Product::when(request('key'),function($q){
                        $q->where('products.name','like','%'.request('key').'%');
                        })
                        ->select('products.*','categories.name as category_name')
                        ->leftJoin('categories','products.category_id','categories.id')
                        -> orderBy('products.created_at','desc')->paginate(4);
       $pizza->appends(request()->all());
    //    dd($pizza->toArray());

        return view('admin.product.pizzaLIst',compact('pizza'));
    }
    // Create Page
    public function createPage(){
        $categories =Category::select('id','name')->get() ;

        return view('admin.product.createpage',compact('categories'));
    }
    public function create(Request $request){
        $this->productValidation($request,'create');
        $data = $this->pushData($request);

        $fileName =uniqid().'_'.$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image']= $fileName;

       Product::create($data);
      return redirect()->route('product#lists');
    }
    // delete
    public function delete($id){
     Product::where('id',$id)->delete();
     return redirect()->route('product#lists')->with(['delete'=>'Pizza list delete is Success']);
    }
    // detail
    public function detail($id){
       $pizza= Product::where('products.id',$id)->select('products.*','categories.name as category_name')
                ->leftJoin('categories','products.category_id','categories.id')
                ->first();
                // dd($pizza->toArray());
        return view('admin.product.detail',compact('pizza'));
    }
    // updatePage
    public function updatePage($id){
        $pizza = Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.product.update',compact('pizza','category'));
    }
    // update
    public function update(Request $request){
        $this->productValidation($request,'update');
        $data = $this->pushData($request);
        // image
        if($request->hasFile('pizzaImage')){
          $oldName = Product::where('id',$request->id)->select('image')->first();
          $oldName = $oldName->image;
            Storage::delete('public/'.$oldName);
             $imgName = uniqid().'_'. $request->file('pizzaImage')->getClientOriginalName();
             $request->file('pizzaImage')->storeAs('public',$imgName);
             $data['image']=$imgName;

        }
       Product::where('id',$request->id)->update($data);
       return redirect()->route('product#lists')->with(['update'=>'Update is successful']);
    }

//    ------------------------------ Private function section----------------------
    private function productValidation($request,$action){
        $validationRule =[
            'pizzaName'=>'required|unique:products,name,'.$request->id,
            'pizzaDescription'=>'required',
            'category'=>'required',
            'pizzaPrice'=>'required',
            'time'=>'required'
        ];
  $validationRule['pizzaImage'] = $action == 'create'?'mimes:jpg,png,jpeg,webp|required':'mimes:jpg,png,jpeg,webp';


        Validator::make($request->all(),$validationRule)->validate();
    }

    private function pushData($request){
        return[
            'category_id'=>$request->category,
            'name'=>$request->pizzaName,
            'description'=>$request->pizzaDescription,
            'price'=>$request->pizzaPrice,
            'waiting_time'=>$request->time,
        ];
    }
}
