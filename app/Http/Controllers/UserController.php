<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\category;
use App\Models\brand;
use App\Models\product;
use App\Models\user;
use App\Models\cart;
use Session;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexlogin(Request $request)
    {
        $request->session()->forget('userName');
        $request->session()->forget('permission');
        return view("login")->with(['mess'=>'']);
    }

    public function indexregister(Request $request)
    {
        return view("register")->with(['mess'=>'']);
    }
    
    public function indexUser(Request $request)
    {   
        $userName = $request->session()->get('userName');
        $user = DB::table('user')->select('user.userName','user.password','user.email','user.address','user.phone')->where('userName',$userName)->get();
        return view("user")->with(['user'=>$user]);
    }

    public function logincontroller(Request $request)
    {
        $mess = '';
        $username = $request->username;
        $password = $request->password;

        $account = DB::table('user')->where('userName',$username)->where('password',$password)->get();

        if (strlen( $account) != 2){
            // Request::session()->put('Alogin', true);
            // Request::session()->put('Uname', $username);
            
            $request->session()->put('userName', $account->get(0)->userName);
            $request->session()->put('permission', $account->get(0)->permission);

            //$test = $request->session()->get('Uname');
         
            return redirect()->route('home');
        }else{
            return view("login")->with(['mess'=>'Account has not already exists']);
        }
        return view("login")->with(['account'=>$account]);
    }

    public function registercontroller(Request $request)
    {
        $id = $request->id;
        $mess = '';
        $username = $request->username;
        $password = $request->password;
        $email = $request->email;
        $address = $request->address;
        $phone = $request->phone;

        $account = DB::table('user')->where('userName',$username)->get();
        if (strlen( $account) != 2){
            return view("register")->with(['mess'=>'Username has already exists']);
        }else{
            $data=array('userName'=>$username,'password'=>$password,'email'=>$email,'permission'=>1,'address'=>$address,'phone'=>$phone);
            DB::table('user')->insert($data);
            return view("register")->with(['mess'=>'Username has created successfully']);
        }
        
        return view("register")->with(['mess'=>$mess]);
    }

    public function userController(Request $request){
        $userName = $request->session()->get('userName');
        $password = $request->password;
        $email = $request->email;
        $address = $request->address;
        $phone = $request->phone;

        DB::table('user')->where('userName',$userName)->update(['password'=>$password,'email'=>$email,'address'=>$address,'phone'=>$phone]);
        return redirect()->route('user');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
