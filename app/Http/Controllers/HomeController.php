<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\category;
use App\Models\brand;
use Session;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listCategory = DB::table('category')->get();
        $listBrand = DB::table('brand')->get();
        $listProduct = DB::table('product')->get();
        return view("home")->with(['listCategory'=>$listCategory,'listBrand'=>$listBrand,'listProduct'=>$listProduct]);
    }

    public function indexlogin()
    {
        return view("login")->with(['mess'=>'']);
    }    

    public function indexregister()
    {
        return view("register")->with(['mess'=>'']);
    }    

    public function brand(Request $request)
    {
        $bid = $request->bid;
        $listProduct = DB::table('product')->where('bid',$bid)->get();
        $listCategory = DB::table('category')->get();
        $listBrand = DB::table('brand')->get();
        return view("home")->with(['listCategory'=>$listCategory,'listBrand'=>$listBrand,'listProduct'=>$listProduct]);
    }

    public function search(Request $request)
    {
        $search = $request->searchName;
        $listProduct = DB::table('product')->where('pName','like',"%$search%")->get();
        $listCategory = DB::table('category')->get();
        $listBrand = DB::table('brand')->get();
        return view("home")->with(['listCategory'=>$listCategory,'listBrand'=>$listBrand,'listProduct'=>$listProduct]);
    }

    public function detail(Request $request)
    {
        $pid = $request->pid;
        $listProduct = DB::table('product')->where('id',$pid)->get();
        $listCategory = DB::table('category')->get();
        $listBrand = DB::table('brand')->get();
        return view("detail")->with(['listCategory'=>$listCategory,'listBrand'=>$listBrand,'listProduct'=>$listProduct]);
    }
    //cart 
    public function cart(Request $request)
    {
        $mess = '';
        $listCategory = DB::table('category')->get();
        $listBrand = DB::table('brand')->get();
        $listProduct = DB::table('product')->get();

        $userName = $request->session()->get('userName');
        $listCart = DB::table('cart')->join('product', 'cart.pid', '=', 'product.id')->select('cart.id','product.pName','product.price','cart.quantity','cart.totalbill','cart.buy','cart.date','cart.status')->where('cart.userName','=',$userName)->orderBy('cart.date', 'desc')->get();
        if (strlen( $listCart) != 2)
            $mess = '1';
        return view("cart")->with(['listCategory'=>$listCategory,'listBrand'=>$listBrand,'listProduct'=>$listProduct,'listCart'=>$listCart,'mess'=>$mess]);
    }

    public function updateCart(Request $request)
    {
        $id = $request->id;
        $update = $request->update;
        $quantity = $request->quantity;
        $price = $request->price;
        if ($update == 'Add'){
            $quantity = $quantity+1;
            DB::table('cart')->where('id', $id)->update(['quantity' => $quantity, 'totalbill' => ($quantity*$price)]);
        }
        else
        if ($update == 'Delete'){
            $quantity = $quantity-1;
            DB::table('cart')->where('id', $id)->update(['quantity' => $quantity, 'totalbill' => ($quantity*$price)]);
        }
        else
        if ($update == 'Buy'){
            DB::table('cart')->where('id', $id)->update(['status' => 1,'buy' => 1]);
        }
        else
        if ($update == 'New'){
            $userName = $request->session()->get('userName');
            $pid = $request->pid;
            $quantity = $request->quantity;
            DB::table('cart')->insert(['userName' => $userName, 'pid' => $pid, 'quantity' => $quantity, 'totalbill' => ($quantity*$price), 'buy' => 0, 'status' => 0, 'date' => NOW()]);
        }
        DB::table('cart')->where('quantity',0)->delete();
        return redirect()->route('cart');
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
