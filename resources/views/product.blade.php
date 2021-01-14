<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <style>
        body{
            background-color: #F2CEF2;
        }
        .header{
            height: 150px;
            width: 100%;
            background-color: #90CDC3;
        }
        .p{
            font-size: 70px;
            color: black;
            text-align: center;
            font-family: 'Nova Mono', cursive;
        }
        .button{
            margin-left: 0px;
            font-family: 'Nova Mono', cursive;
            /* width: 100%; */
        }

        .category{
            height: auto;
            width: 100%;
        }

        .flex-container {
            display: flex;
            background-color: #f1f1f1;
            font-size: 20px;
            flex-wrap: wrap;
            margin: auto;
            width: 1500px;
        }   

        .product-box {
            width: 200px; 
            height: 450px; 
            padding: 5px; 
            text-align: center; 
            border: 10px solid #f1f1f1;
            font-size: 20px;
            font-family: 'Nova Mono', cursive;
        }

        .product-box:hover {
            width: 200px; 
            height: 450px; 
            padding: 5px; 
            text-align: center; 
            border: 10px solid #f1f1f1;
            background: #cccccc;
            color: black;
            font-family: 'Nova Mono', cursive;
        }
        .icon{
            position: absolute;         
            z-index: 1;
            color: #4f5b66;
        }
        .contain{
            width: 250px;
            height: 35px;
            background: #ffffff;
            border: none;
            padding-left: 30px;
            border-radius: 15px;
        }
        .search{
            float: right;
            margin-right: 10px;
            
        }
        .cart{
            height: 30px;
            width: 100%;
            background-color: white;    
        }
    </style>
  <body>
    <div class="cart">
        @if(Session::has('userName'))
            <p style=" width: 150px; float: left;">Hello {{ Session::get('userName')}} </p>
        @endif

        <button style="float: right;" type="button" class="btn btn-light"><a href="login">Sign out</a></button>
            
        @if(Session::get('permission') == '1')
            <button style="float: right;" type="button" class="btn btn-light"><a href="cart">Cart</a></button>
        @else
            <button style="float: right;" type="button" class="btn btn-light"><a href="cart">Cart</a></button>
        @endif
    </div>

    <div class="header">      
        <p class="p">Product</p>
    </div>

    <div class="btn-group">
        <button type="button" class="btn btn-light" ><a href="/home">Home</a></button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn-light" ><a href="/product?make=Add">Add</a></button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn-light" ><a href="/product?make=Update">Update</a></button>
    </div>
    <div class="btn-group">
        <p style="margin: auto; color: red;">{{ $mess }}</p>
    </div>

    <!-- Add and Update -->
    <!-- Add -->
    @if($make == 'Add')
        <form action="{{url('Add')}}" method="get" >
            @csrf
            <table class="table table-hover" style="background: white; width: 900px; margin: auto;">
                <tr>
                    <th style=" width: 60px;">
                        <p>Category:</p>
                    </th>
            
                    <th>
                        <select id="mySelect1" name="categoryid" style="width: 300px;" onchange="myFunction1()">
                            <option value="-1">Add new Category</option>
                            @foreach($listCategory as $c) 
                                @if($categoryid == $c->Cid)
                                    <option value="{{ $c->Cid }}" selected="selected">{{ $c->Cname }}</option>
                                 @else
                                    <option value="{{ $c->Cid }}">{{ $c->Cname }}</option>
                                 @endif
                            @endforeach
                        </select>
                    </th>

                    @if($categoryid == -1)
                        <th>
                            <input type="text" style="width: 300px" class="form-control" name="NewCategory" placeholder="Enter New Category" required>
                        </th>
                        <th style=" width: 60px;">
                            <button type="Submit" class="btn btn-info" name="Submit" value="AddCategory">Add</button>
                        </th> 
                    @endif
                </tr>

                @if($categoryid != -1)
                    <tr>
                        <th style=" width: 60px;">
                            <p>Brand:</p>
                        </th>
            
                        <th>
                            <select id="mySelect2" name="brandid" style="width: 300px;" onchange="myFunction2()">
                                <option value="-1">Add new Brand</option>
                                @foreach($listBrand as $b) 
                                    @if($brandid == $b->id)
                                        <option value="{{ $b->id }}" selected="selected">{{ $b->bName }}</option>
                                    @else
                                        <option value="{{ $b->id }}">{{ $b->bName }}</option>
                                    @endif
                                @endforeach        
                            </select>
                        </th>

                        @if($brandid == -1)
                            <th>
                                <input type="text" style="width: 300px" class="form-control" name="NewBrand" placeholder="Enter New Brand" required>
                            </th>
                            <th style=" width: 60px;">
                                <button type="Submit" class="btn btn-info" name="Submit" value="AddBrand">Add</button>
                            </th> 
                        @endif
        
                    </tr> 
                @endif
                @if($brandid != -1)
                    <tr>
                        <th style=" text-align: center; color: red;">
                            <p>Enter new Product:</p>
                        </th>
                    </tr> 
                    <tr>
                        <th style=" width: 60px;">
                            <p>Enter Name Product:</p>
                        </th>
                        <th>
                            <input type="text" style="width: 300px" class="form-control" name="pName" placeholder="Enter Name Product" required>
                        </th>
                    </tr>
                    <tr>
                        <th style=" width: 60px;">
                            <p>Enter Img Product:</p>
                        </th>
                        <th>
                            <input type="text" style="width: 300px" class="form-control" name="img" placeholder="Enter Img Product" required>
                        </th>
                    </tr>
                    <tr>
                        <th style=" width: 60px;">
                            <p>Enter Price Product:</p>
                        </th>
                        <th>
                            <input type="text" style="width: 300px" class="form-control" name="price" placeholder="Enter Price Product" required>
                        </th>
                    </tr>
                    <tr>
                        <th style=" width: 60px;">
                            <p>Enter Information Product:</p>
                        </th>
                        <th>
                            <input type="text" style="width: 300px" class="form-control" name="information" placeholder="Enter Information Product" required>
                        </th>
                    </tr>
                    <tr>
                        <th style=" width: 60px;">
                            <button type="Submit" class="btn btn-info" name="Submit" value="AddProduct">Add</button>
                        </th> 
                    </tr>
                @endif
            </table>
        </form>
    <!-- Update -->
    @elseif($make == 'Update')
        <form action="{{url('Update')}}" method="get" >
            @csrf
            <table class="table table-hover" style="background: white; width: 900px; margin: auto;">
                <tr>
                    <th style=" width: 60px;">
                        <p>Category:</p>
                    </th>
            
                    <th>
                        <select id="mySelect3" name="categoryid" style="width: 300px;" onchange="myFunction3()">
                            <option value="-1">Choose a Category</option>
                            @foreach($listCategory as $c) 
                                @if($categoryid == $c->Cid)
                                    <option value="{{ $c->Cid }}" selected="selected">{{ $c->Cname }}</option>
                                 @else
                                    <option value="{{ $c->Cid }}">{{ $c->Cname }}</option>
                                 @endif
                            @endforeach
                        </select>
                    </th>

                    @if($categoryid != -1)
                        <th>
                            <input type="text" style="width: 300px" class="form-control" name="NewCategory" placeholder="Update New Category" >
                        </th>
                        <th style=" width: 60px;">
                            <button type="Submit" class="btn btn-info" name="Submit" value="UpdateCategory">Update</button>
                        </th> 
                    @endif
                </tr>

                @if($categoryid != -1)
                    <tr>
                        <th style=" width: 60px;">
                            <p>Brand:</p>
                        </th>
            
                        <th>
                            <select id="mySelect4" name="brandid" style="width: 300px;" onchange="myFunction4()">
                                <option value="-1">Choose a Brand</option>
                                @foreach($listBrand as $b) 
                                    @if($brandid == $b->id)
                                        <option value="{{ $b->id }}" selected="selected">{{ $b->bName }}</option>
                                    @else
                                        <option value="{{ $b->id }}">{{ $b->bName }}</option>
                                    @endif
                                @endforeach        
                            </select>
                        </th>

                        @if($brandid != -1)
                            <th>
                                <input type="text" style="width: 300px" class="form-control" name="NewBrand" placeholder="Update New Brand" >
                            </th>
                            <th style=" width: 60px;">
                                <button type="Submit" class="btn btn-info" name="Submit" value="UpdateBrand">Update</button>
                            </th> 
                        @endif
                    </tr> 
                @endif
            </table>

            <br><br><br>

            @if($brandid != -1)
                <table  name="tblProduct" class="table table-hover" style="background: white; width: 1700px; margin: auto;">
                    <tr>
                        <th style="width: 80px;" >id</th>
                        <th>Name</th>
                        <th>Img</th>
                        <th style="width: 100px;">Price($)</th>
                        <th style="width: 30px;">Brand</th>
                        <th style="width: 30px;">Category</th>
                        <th>Information</th>
                        <th >Delete</th>
                    </tr>
                    @foreach($listProduct as $p) 
                    <tr>
                        <td><input type="text" name="id[]" class="form-control" value ="{{ $p->id }}" readonly></td>
                        <td><input type="text" name="pName[]" class="form-control" value ="{{ $p->pName }}"></td>
                        <td><input type="text" name="img[]" class="form-control" value ="{{ $p->img }}" ></td>
                        <td><input type="text" name="price[]" class="form-control" value ="{{ $p->price }}" ></td>
                        <td><input type="text" name="bid[]" class="form-control" value ="{{ $p->bid }}" readonly></td>
                        <td><input type="text" name="cid[]" class="form-control" value ="{{ $p->cid }}" readonly></td>
                        <td><input type="text" name="information[]" class="form-control" value ="{{ $p->information }}" ></td>
                        <td><input type="checkbox" name="delete[]" value="{{ $p->id }}"></td>
                    </tr>
                    @endforeach        
                </table>   
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <button class="btn btn-info" type="submit" name="Submit" value="UpdateProduct">Update</button>     
            @endif
        </form>
    @endif
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        function myFunction1() {
            var x = document.getElementById("mySelect1").value;
            location.href = "loadAdd?categoryid="+x;
        }
        function myFunction2() {
            var x = document.getElementById("mySelect2").value;
            var y = document.getElementById("mySelect1").value;
            location.href = "loadAdd?brandid="+x+"&categoryid="+y;
        }

        function myFunction3() {
            var x = document.getElementById("mySelect3").value;
            location.href = "loadUpdate?categoryid="+x;
        }
        function myFunction4() {
            var x = document.getElementById("mySelect4").value;
            var y = document.getElementById("mySelect3").value;
            location.href = "loadUpdate?brandid="+x+"&categoryid="+y;
        }

        function myFunction5() {
            var x = document.getElementById("tblProduct").value;
            location.href = "Update?Submit=UpdateProduct&tblProduct="+x;
            
        }
    </script>
  </body>
</html>