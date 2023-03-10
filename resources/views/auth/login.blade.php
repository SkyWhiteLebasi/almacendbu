<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DBU | Almacen </title>

<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('forlogin/fontawesome-free/css/all.min.css')}}">
   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

   <link rel="stylesheet" href="{{asset('forlogin/icheck-bootstrap.min.css')}}">

   <link rel="stylesheet" href="{{asset('forlogin/adminlte.min.css')}}">

</head>
<body class="hold-transition login-page logini">
    <style>
      .logini{
        height: 100%;
      
      }
      .logini {
          padding: 80px 0px;
          background: url(img/universidad.jpg);
          background-position: center;
          background-size: 100%;
          background-repeat: no-repeat;
          position: relative;
          text-align: center;
           
          width:100%;
          z-index: 1;
      }
      .login-box{
        opacity: 0.95;      
      }
      img.opacity {
          opacity: 1;
          filter: alpha(opacity=50);
          zoom: 1;
      }

      img.opacity:hover {
          opacity: 0.5;
          filter: alpha(opacity=100);
          zoom: 1;
      }
      
      ._main_head_as{
    margin:20px 0 25px 0px;
    display:inline-block;
    z-index:2;
    position:relative; 
  }
  
  ._main_head_as a img{
    height:100px;
    width:100px;
    position:relative;
   /* border-radius:50px;*/
  }
  .form-sub-main{
      color:#545454;
      font-size:20px;
      margin-top: 5%;
  }
  .yara{
      background-color: rgb(0, 0, 0);   
  }
 
    </style>
   <script>
    function bigImg(x) {
      x.style.height = "200px";
      x.style.width = "200px";
    }
    
    function normalImg(x) {
      x.style.height = "128px";
      x.style.width = "128px";
    }
    </script>
  <div class="login-box" >

    <div class="card card-outline card-danger">
      <div class="card-header text-center yara">
        <a href="#">
          <img src="img/logouna.png"  class="opacity">
        </a>
      </div>
      <div class="card-body">
        <p class="login-box-msg"><b>Subunidad de Servicio de Comedores</b></p>

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Ingrese su email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Ingrese su contrase??a">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-danger btn-block">Ingresar</button>
          </div>

        </div>
      </form>
      
    </div>
  </div>
  <!-- /.card -->
</div>

<script src="{{asset('forlogin/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('forlogin/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('forlogin/adminlte.min.js')}}"></script>
</body>
</html>
