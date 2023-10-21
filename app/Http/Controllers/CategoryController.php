<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //list page
    public function list(){
        // dd(request('key'));
        $categories = Category::when(request('key'),function($query){
                  $query->where('name','like','%'.request('key').'%');
                   })->orderBy('id','desc')
                     ->paginate(5);
            $categories->appends(request()->all());

        return view('admin.category.list',compact('categories'));

    }
    // create page
    public function create(){
        return view('admin.category.create');
    }
    // create
    public function Addcreate(Request $request){
      $this->createValidation($request);
      $data = $this->createData($request);
      Category::create($data);
      return redirect()->route('category#listpage')->with(['createSuccess'=>"Category Create Successful!"]);
    }
    // delete
    public function delete($id){
      Category::where('id',$id)->delete();
      return back()->with(['delete'=>'Category list is deleted!']);
    }
    // edit
    public function edit($id){
        $update=Category::where('id',$id)->first();
        return view('admin.category.edit',compact('update'));
    }
    // update
    public function update(Request $request){
        $this->createValidation($request);
        $id = $request->id;
        $data=$this->createData($request);
        Category::where('id',$id)->update($data);
        return redirect()->route('category#listpage');
    }



    // createValidation
    private function createValidation($request){
        Validator::make($request->all(),[
            'categoryName'=>'required|unique:categories,name,'.$request->id
        ],[
            'categoryName.required'=>'fill to name required.',
            'categoryName.unique'=>'title name is not same'
        ])->validate();
    }
    // createData
    private function createData($request){
        return [
            'name'=>$request->categoryName
        ];
    }
}
