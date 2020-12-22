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

        @if (Session::get('permission') == '0')
            <p style="float: right; width: 150px; height: 30px;">day la admin</p>
        @else
            <p style="float: right; width: 150px; height: 30px;">day la user</p>
        @endif
    </div>

    <div class="header">      
        <p class="p">Cart</p>
    </div>
    <div class="category">
        <div class="btn-group">
            <button type="button" class="btn btn-light" ><a href="/home">Home</a></button>
            @foreach($listCategory as $c) 
                <div class="btn-group">
                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">{{ $c->Cname }}</button>
                    <div class="dropdown-menu">
                        @foreach($listBrand as $b) 
                            @if($b->Cid == $c->Cid)
                                <a class="dropdown-item" href="Brand?bid={{ $b->id }}">{{ $b->bName }}</a>
                            @endif                             
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div> 
        <div class="search">
            <form action="search" method="get"  >
                <input class="contain" type="text" name="searchName" placeholder="Search..."> 
                <input type="submit" value="Search"></imput>
            </form>
        </div>   
    </div>

    @if( $mess  == '')
            <p>ban chua mua hang</p>
        @else
            <div class="container">
            <h2>Cart of {{ Session::get('userName')}}</h2>
            <table class="table table-hover" style="background: white;">
                <thead>
                    <tr>
                        <th>Name of Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Add</th>
                        <th>Delete</th>
                        <th>Buy</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($listCart as $c) 
                    <tr>
                        <td>{{ $c->pName }}</td>
                        <td>{{ $c->price }}</td>
                        <td>{{ $c->quantity }}</td>
                        <td><button type="button" class="btn btn-outline-success"><a href="updateCart?update=Add&id={{ $c->id }}&quantity={{ $c->quantity }}">Add</a></button></td>
                        <td><button type="button" class="btn btn-outline-danger"><a href="updateCart?update=Delete&id={{ $c->id }}&quantity={{ $c->quantity }}">Delete</a></button></td>
                        <td><button type="button" class="btn btn-outline-info"><a href="updateCart?update=Buy&id={{ $c->id }}">Buy</a></button></td>
                        <td>
                            @if($c->status == '1')
                                <button type="button" class="btn btn-success">Success</button>
                            @endif  
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>

        @endif

        
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>