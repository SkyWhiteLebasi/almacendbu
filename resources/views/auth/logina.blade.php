@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

<body class="hold-transition login-page logini">
    <style>
      .logini{
        height: 100%;
      
      }
      .logini {
          padding: 80px 0px;
          background: url(backend/dist/img/universidad.jpg);
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
    
    <!-- /.login-logo
    <div class="form-sub-main">
      <div class="_main_head_as">
        <a href="#"> -->
         <!--   <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src="backend/dist/img/logodbu.png">
       </a>
      </div>
    </div>--> 
    <div class="card card-outline card-danger">
      <div class="card-header text-center yara">
        <a href="#">
          <img src="backend/dist/img/logouna.png"  class="opacity">
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
          <input type="password" name="password" class="form-control" placeholder="Ingrese su contraseña">
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
          
          <!-- /.col -->
        </div>
      </form>
      
      <p class="mb-0">
        <a href="{{route('register')}}" class="text-center">Registrar un nuevo usuario</a>
      </p>
      
      <!-- /.social-auth-links -->

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->


</body>