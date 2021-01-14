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
            height: 39px;
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
                <button style="float: right;" type="button" class="btn btn-light"><a href="product">Admin</a></button>
            @endif
      </div>

        <div class="header">      
            <p class="p">Information</p>
        </div>
        <button type="button" class="btn btn-light" ><a href="/home">Home</a></button>
        <br><br>
      @if(Session::get('permission') == '1')  
        <form action="{{url('userController')}}" method="post" >
          @csrf
          <table class="table table-hover" style="background: white; width: 800px; margin: auto;">
              <tr>
                  <th style=" width: 60px;">
                    <p>User Name:</p>
                  </th>
                  <th>
                    <input type="text" name="userName" class="form-control" value ="{{ $user[0]->userName }}" readonly>   
                  </th>
              </tr>
              <tr>
                  <th style=" width: 60px;">
                    <p>Password:</p>
                  </th>
                  <th>
                    <input type="text" name="password" class="form-control" value ="{{ $user[0]->password }}">   
                  </th>
              </tr>
              <tr>
                  <th style=" width: 60px;">
                    <p>Email:</p>
                  </th>
                  <th>
                    <input type="text" name="email" class="form-control" value ="{{ $user[0]->email }}">   
                  </th>
              </tr>
              <tr>
                  <th style=" width: 60px;">
                    <p>Address:</p>
                  </th>
                  <th>
                    <input type="text" name="address" class="form-control" value ="{{ $user[0]->address }}">   
                  </th>
              </tr>
              <tr>
                  <th style=" width: 60px;">
                    <p>Phone:</p>
                  </th>
                  <th>
                    <input type="text" name="phone" class="form-control" value ="{{ $user[0]->phone }}" >   
                  </th>
              </tr>
              <tr>
                  <th style=" width: 60px;">
                    <button class="btn btn-info" type="submit" name="Submit" value="UpdateProduct">Save</button>     
                  </th>
              </tr>
          </table>
        </form>
      @endif         
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>