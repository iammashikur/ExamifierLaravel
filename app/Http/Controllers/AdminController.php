<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\StudentData;
use Carbon;

class AdminController extends Controller
{

    public function login()
    {
        return view('auth.backend_login');
    }

    public function index(){


        $students = User::where('is_admin' , null)->where('is_examiner' , null)->paginate(10);
        $examiners = User::where('is_examiner' , 1)->paginate(10);

        return view('admin_dashboard', compact('students','examiners'));

    }


    public function delete($id){


        $students = User::where('id' , $id)->delete();
        $students = StudentData::where('student_id' , $id)->delete();

        return redirect()->back();

    }

    public function add_user()
    {
        return view('admin_add_user');
    }

    public function add_examiner()
    {
        return view('admin_add_examiner');
    }

    public function store_user(Request $request)
    {
        $exist = User::where('phone', $request->phone)->count();

        if($exist == 1){
            return redirect()->back()->with('error' , 'Phone Number Already Exist!');
        }

       $count = strlen($request->password);

        if($count < 8){

            return redirect()->back()->with('error' , 'Password bust be 8 or more charecters!');

        }else{

            if($request->password == $request->password_confirmation){

                $user = User::where('phone', $request->phone)->insert([

                    'name' => $request->name,
                    'phone' => $request->phone,
                    'password' => bcrypt($request->password),
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now(),

                ]);

                return redirect()->route('admin.dashboard')->with('success' , 'User Added');

            }

            else{
                return redirect()->back()->with('error' , 'Password Not Match');
            }

        }


    }

    public function store_examiner(Request $request)
    {
        $exist = User::where('phone', $request->phone)->count();

        if($exist == 1){
            return redirect()->back()->with('error' , 'Phone Number Already Exist!');
        }

       $count = strlen($request->password);

        if($count < 8){

            return redirect()->back()->with('error' , 'Password bust be 8 or more charecters!');

        }else{

            if($request->password == $request->password_confirmation){

                $user = User::where('phone', $request->phone)->insert([

                    'name' => $request->name,
                    'phone' => $request->phone,
                    'is_examiner' => 1,
                    'password' => bcrypt($request->password),
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now(),

                ]);

                return redirect()->route('admin.dashboard')->with('success' , 'User Added');

            }

            else{
                return redirect()->back()->with('error' , 'Password Not Match');
            }

        }

    }

    public function edit($id)
    {
        $user = User::where('id', $id)->get();
        return view('admin_edit_user', compact('user'));
    }

    public function update(Request $request)
    {
        $exist = User::where('phone', $request->phone)->count();

        if($exist == 1){
            return redirect()->back()->with('error' , 'Phone Number Already Exist!');
        }

       $count = strlen($request->password);

        if($count < 8){

            return redirect()->back()->with('error' , 'Password bust be 8 or more charecters!');

        }else{

            if($request->password == $request->password_confirmation){

                $user = User::where('phone', $request->phone)->insert([

                    'name' => $request->name,
                    'phone' => $request->phone,
                    'password' => bcrypt($request->password),
                    'updated_at' => Carbon\Carbon::now(),

                ]);

                return redirect()->route('admin.dashboard')->with('success' , 'User Added');

            }

            else{
                return redirect()->back()->with('error' , 'Password Not Match');
            }

        }

    }

    public function search(Request $request)
    {

        if($request->has('search')) {


        $examiners = User::where('is_examiner' , 1)->paginate(10);

        $searchQuery = $request->search;
        $requestData = ['name', 'phone'];
         $students = User::where('is_admin' , null)->where('is_examiner' , null)->where(function($q) use($requestData, $searchQuery) {
                               foreach ($requestData as $field)
                                  $q->orWhere($field, 'like', "%{$searchQuery}%");
                       })->paginate(10);


                       return view('admin_search', compact('students','examiners','request'));



        } else {
            return route('/');
        }





    }




}
