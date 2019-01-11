<!-- <head>
  <title>@if(isset($title)){{$title}}@endif</title>
  <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
</head>
<br>
<br>
<br>
 <div class="container">
  	<div class="row">
  		<div class="col-md-3 col-lg-3 col-sm-0"></div>
  		<div class="col-md-6 col-lg-6 col-sm-12">
  			<form role="form" action="{{route('admin.login')}}" method="post">
  				@method('post')
  				@csrf
  				<div class="form-group">
  					<label for="email">Email:</label>
  					<input type="email" name="email" required="required" class="form-control">
  				</div>
  				<div class="form-group">
  					<label for="password">Password:</label>
  					<input type="password" name="password" required="required" class="form-control">
  				</div>
  				<br>
  				<center><a href="#" class="btn btn-link">Forget Password.....?</a><br></center>
  				<div class="form-group">
  					<button type="submit" class="btn btn-primary">Login</button>
  					<a href="#" class="btn btn-warning">Cancell</a>
  				</div>
  			</form>

  		</div>
  		<div class="col-md-3 col-lg-3 col-sm-0"></div>
  	</div>
  </div> -->

<head>
     <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{asset('assets/vendor/fonts/circular-std/style.css" rel="stylesheet')}}">
    <link rel="stylesheet" href="{{asset('assets/libs/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css')}}">

</head>
  <body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a href="../index.html"><img class="logo-img" src="{{URL::asset('assets/images/logo.png')}}" alt="logo"></a><span class="splash-description">Please enter your user information.</span></div>
            <div class="card-body">
                <form action="{{route('admin.login')}}" method="post">
				@method('post')
  				@csrf
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="username" type="text" placeholder="Email" autocomplete="off" name="email">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password" type="password" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remember"><span class="custom-control-label">Remember Me</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0  ">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="#" class="footer-link">Create An Account</a></div>
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="#" class="footer-link">Forgot Password</a>
                </div>
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="{{asset('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script> 
</body>