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

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $make = $request->make;
        if($make == null){
            return view("product")->with(['make'=>'','mess'=>'Choose an action']);
        }
        elseif($make == 'Add'){
            return redirect()->route('Add');
        }
        elseif($make == 'Update'){
            return redirect()->route('Update');
        }
    }

    //Add
    public function Add(Request $request)
    {   
        $mess='';
        $listCategory;
        $listBrand;

        $Submit = $request->Submit;
        
        if ($Submit == 'AddCategory'){
            $mess='';
            $NewCategory = $request->NewCategory;
            $check = DB::table('category')->where('Cname',$NewCategory)->get();
            if (strlen( $check) != 2){
                $mess = 'Category has exists';   
            }
            else{
                $mess = 'Add Category Success';
                DB::table('category')->insert(['Cname'=>$NewCategory]);
            }
        }
        elseif($Submit == 'AddBrand'){
            $mess='';
            $categoryid = $request->categoryid;
            $NewBrand = $request->NewBrand;
            $check = DB::table('brand')->where('Cid',$categoryid)->where('bName',$NewBrand)->get();
            if (strlen( $check) != 2){
                $mess = 'Brand has exists';   
            }
            else{
                $mess = 'Add Brand Success';
                DB::table('brand')->insert(['bName'=>$NewBrand,'Cid'=>$categoryid]);
            }
        }
        elseif($Submit == 'AddProduct'){
            $mess='';
            $categoryid = $request->categoryid;
            $brandid = $request->brandid;
            $pName = $request->pName;
            $img = $request->img;
            $price = $request->price;
            $information = $request->information;
            $check = DB::table('product')->where('cid',$categoryid)->where('bid',$brandid)->where('pName',$pName)->get();
            if (strlen( $check) != 2){
                $mess = 'Product has exists';   
            }
            else{
                $mess = 'Add Product Success';
                DB::table('product')->insert(['pName'=>$pName,'img'=>$img,'price'=>$price,'bid'=>$brandid,'cid'=>$categoryid,'information'=>$information]);
            }
        }
        $listCategory = DB::table('category')->get();
        $listBrand = DB::table('brand')->get();;
        return view("product")->with(['make'=>'Add','listCategory'=>$listCategory,'categoryid'=> -1,'listBrand'=>$listBrand,'brandid'=> -1,'mess'=>$mess]);
    }


    public function loadAdd(Request $request)
    {   
        $mess='';
        $categoryid = $request->categoryid;
        $listCategory = DB::table('category')->get();
        $listBrand;
        if ($categoryid == -1){
            return redirect()->route('Add');
        }
        else{
            $brandid = $request->brandid;
            if ($brandid == null){
                $brandid = -1;
            }

            $listBrand = DB::table('brand')->where('Cid',$categoryid)->get();
            if (strlen($listBrand) != 2){
                return view("product")->with(['make'=>'Add','listCategory'=>$listCategory, 'brandid'=>$brandid, 'categoryid'=> $categoryid, 'listBrand'=>$listBrand,'mess'=>$mess]);
            }
            else{
                return view("product")->with(['make'=>'Add','listCategory'=>$listCategory, 'categoryid'=> $categoryid, 'listBrand'=>$listBrand, 'brandid'=> -1,'mess'=>$mess]);
            }
        }
        return view("product")->with(['make'=>'Add','listCategory'=>$listCategory, 'listBrand'=>$listBrand, 'categoryid'=> $categoryid, 'brandid'=> -1,'mess'=>$mess]);
    }

    //Update
    public function Update(Request $request){
        $mess='';
        $listCategory;
        $listBrand;

        $Submit = $request->Submit;
        if ($Submit == 'UpdateCategory'){
            $categoryid = $request->categoryid;
            $NewCategory = $request->NewCategory;
            $mess = 'Update Category Success';
            DB::table('category')->where('Cid',$categoryid)->update(['Cname'=>$NewCategory]);
        }
        elseif($Submit == 'UpdateBrand'){
            $brandid = $request->brandid;
            $NewBrand = $request->NewBrand;
            $mess = 'Update Brand Success';
            DB::table('brand')->where('id',$brandid)->update(['bName'=>$NewBrand]);
        }
        elseif($Submit == 'UpdateProduct'){
            $id = $request->id;
            $pName = $request->pName;
            $img = $request->img;
            $price = $request->price;
            $information = $request->information;
            $delete = $request->delete;
            
            if (!empty($delete)){
                foreach($delete as $d){
                    DB::table('product')->where('id', $d)->delete();
                }
            }
            
            for ($i=0; $i < count($id); $i++){
                DB::table('product')->where('id',$id[$i])->update(['pName'=>$pName[$i],'img'=>$img[$i],'price'=>$price[$i],'information'=>$information[$i]]);
            }

            $mess = 'Update Product Success';
        }
        $listCategory = DB::table('category')->get();
        $listBrand = DB::table('brand')->get();;
        return view("product")->with(['make'=>'Update','listCategory'=>$listCategory,'categoryid'=> -1,'listBrand'=>$listBrand,'brandid'=> -1,'mess'=>$mess]);
    }

    public function loadUpdate(Request $request)
    {   
        $mess='';
        $categoryid = $request->categoryid;
        $listCategory = DB::table('category')->get();
        $listBrand;
        $listProduct;
        if ($categoryid == -1){
            return redirect()->route('Update');
        }
        else{
            $brandid = $request->brandid;
            if ($brandid == null){
                $brandid = -1;
            }
            
            
            $listBrand = DB::table('brand')->where('Cid',$categoryid)->get();
            if (strlen($listBrand) != 2){
                $listProduct = DB::table('product')->where('cid',$categoryid)->where('bid',$brandid)->get();
                return view("product")->with(['make'=>'Update','listCategory'=>$listCategory, 'brandid'=>$brandid, 'categoryid'=> $categoryid, 'listBrand'=>$listBrand,'listProduct'=>$listProduct,'mess'=>$mess]);
            }
            else{
                return view("product")->with(['make'=>'Update','listCategory'=>$listCategory, 'categoryid'=> $categoryid, 'listBrand'=>$listBrand, 'brandid'=> -1,'listProduct'=>$listProduct,'mess'=>$mess]);
            }
        }
        return view("product")->with(['make'=>'Update','listCategory'=>$listCategory, 'listBrand'=>$listBrand, 'categoryid'=> $categoryid, 'brandid'=> -1,'listProduct'=>$listProduct,'mess'=>$mess]);
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
