<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
        // admin page
    // change password page
    public function passwordChangePage(){
        return view('admin.account.changePassword');
    }
    // change password
    public function changePassword(Request $request){
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

    // Account Detail page
    public function accountDetail(){
        return view('admin.account.detail');
    }
    // Account Edit page
    public function accountEdit(){
        return view('admin.account.edit');
    }
    // Account Update
    public function accountUpdate($id,Request $request){

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
        return redirect()->route('admin#accountPage');
    }

    // Admin List
    public function adminList(){
        $admin = User::when(request('key'),function($query){
                $query->where('name','like','%'.request('key').'%')
                    //   ->orwhere('email','like','%'.request('key').'%')
                    //   ->orwhere('phone','like','%'.request('key').'%')
                    //   ->orwhere('gender','like','%'.request('key').'%')
                    //   ->orwhere('address','like','%'.request('key').'%')
                    ;
        })-> where('role','admin')->paginate(3);

        $admin->appends(request()->all());
           return view('admin.account.adminList',compact('admin'));
    }
    // delete list
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['delete'=> 'Admin account delete is successful']);
    }
    // change role
    public function change(Request $request){
        logger($request->all());
        User::where('id',$request->roleId)->update([
            'role'=> $request->value
        ]);

    }

    // User Lists
    public function userList(){
        $user =User::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })->where('role','user')->paginate(3);
        return view('admin.account.userList',compact('user'));
    }
    // Ban state
    public function banState(Request $request){
        logger($request->all());
       User::where('id',$request->roleId)->update([
        'suspend'=> $request->value
       ]);
    }



    // ----------------------------------------Private function--------------------------------
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

    // Validation section
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6',
            'newPassword'=>'required|min:6',
            'confrimPassword'=>'required|min:6|same:newPassword'
        ])->validate();
    }
}
