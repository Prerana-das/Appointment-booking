<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Role;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    public function index(Request $request){
        // first check if you are loggedin and admin user ... 
        if(!Auth::check() && $request->path() != 'login'){
            return redirect('/login');
        }
        if(!Auth::check() && $request->path() == 'login' ){
            return view('welcome');
        }
        // you are already logged in... so check for if you are an admin user.. 
        $user = Auth::user();
        if($user->userType =='User'){
            return redirect('/login');
        }
        if($request->path() == 'login'){
            return redirect('/');
        }
        return view('welcome');
        
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
    // public function upload(Request $request){
    //     $this->validate($request, [
    //         'file' => 'required|mimes:jpeg,jpg,png'
    //     ]);
    //     $picName = time().'.'.$request->file->extension();
    //     $request->file->move(public_path('uploads'),$picName );
    //     return $picName;
    // }
    // public function deleteImage(Request $request){
    //     $fileName = $request->imageName; 
    //     $this->deleteFileFromServer($fileName, false);
    //     return 'done';
    // }
    // public function deleteFileFromServer($fileName, $hasFullPath = false){
    //     if(!$hasFullPath){
    //         $filePath = public_path().'/uploads/'.$fileName;
    //     }
    //     if(file_exists($filePath)){
    //         @unlink($filePath);
    //     }
    //     return;
    // }
    public function addCategory(Request $request){
        // validate request 
        $this->validate($request, [
            'categoryName' => 'required',
        ]);
        return Category::create([
            'categoryName' => $request->categoryName,
        ]);
    }
    public function getCategory(Request $request){
        // return Category::orderBy('id', 'desc')->get();
        $total = $request->total;
        $data = Category::orderBy('id','desc');
        return $data->paginate($total);
    }
    public function get_all_categoryy(Request $request){
        return Category::orderBy('id', 'desc')->get();
    }
    public function editCategory(Request $request){
        // validate request 
        $this->validate($request, [
            'categoryName' => 'required',
        ]);
        return Category::where('id', $request->id)->update([
            'categoryName' => $request->categoryName
        ]);
    }
    public function deleteCategory(Request $request){
        // validate request 
        $this->validate($request, [
            'id' => 'required', 
        ]);
        return Category::where('id', $request->id)->delete();
    }
    public function createUser(Request $request){
         // validate request 
         $this->validate($request, [
            'fullName' => 'required',
            'email' => 'bail|required|email|unique:users',
            'password' => 'bail|required|min:6',
            'role_id' => 'required',
        ]);
        $password = bcrypt($request->password);
        $user = User::create([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'password' => $password,
            'userType' => $request->userType,
        ]);
        return $user;
    }
    public function editUser(Request $request){
         // validate request 
         $this->validate($request, [
            'fullName' => 'required',
            'email' => "bail|required|email|unique:users,email,$request->id",
            'password' => 'min:6',
            'userType' => 'required',
        ]);
        $data = [
            'fullName' => $request->fullName,
            'email' => $request->email,
            'userType' => $request->userType,
        ];
        if($request->password){
            $password = bcrypt($request->password);
            $data['password'] = $password;
        }
        $user = User::where('id', $request->id)->update($data);
        return $user;
    }

    public function getUsers(){
        return User::get();
    }
    public function adminLogin(Request $request){
         // validate request 
        $this->validate($request, [
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:6',
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            if($user->userType == 'User'){
                Auth::logout();
                return response()->json([
                    'msg' => 'Incorrect login details', 
                ], 401);
            }
            return response()->json([
                'msg' => 'You are logged in', 
                'user' => $user
            ]);
        }else{
            return response()->json([
                'msg' => 'Incorrect login details', 
            ], 401);
        }

    }

    public function get_all_category(){
        return Category::all();
    }

    public function get_first_category(){
        return Category::all()->first();
    }




   



}


