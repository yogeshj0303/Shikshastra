<!DOCTYPE html>
<html lang="en">

<head>

	<title>Spires
        
    </title>
	<!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 11]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Phoenixcoded" />
	<!-- Favicon icon -->
	<link rel="icon" href="backend/assets/images/favicon.ico" type="image/x-icon">

	<!-- vendor css -->
	<link rel="stylesheet" href="backend/assets/css/style.css">




</head>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content text-center">
        <!--<h3 class="text-white">Spires</h3>-->
		 
		<div class="card borderless">
			<div class="row align-items-center ">
				<div class="col-md-12">
					<div class="card-body">
					     <img src="backend/assets/images/auth/logo.png" alt="" style="background-color:black; width:80%" class="img-fluid mb-4">  
					     	<h4 class="mb-3 f-w-400">Signin</h4>
                        <p class="text text-danger">
                            @if (session()->has('msg'))
                                {{ session()->get('msg') }}
                            @endif
                        </p>
					
                        <form action="{{ url('/') }}/admlogin" method="POST">
                            @csrf
						<hr>


						<div class="form-group mb-3">
							<input type="text" class="form-control"  name="email"  id="Email" placeholder="Email address">
						</div>
						<div class="form-group mb-4">
							<input type="password" class="form-control" name="password"  id="Password" placeholder="Password">
						</div>
						
						<button class="btn btn-block btn-primary mb-4">Signin</button>
						<hr>
                        </form>
						{{--  <p class="mb-2 text-muted">Forgot password? <a href="auth-reset-password.html" class="f-w-400">Reset</a></p>
						<p class="mb-0 text-muted">Don’t have an account? <a href="auth-signup.html" class="f-w-400">Signup</a></p>  --}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="backend/assets/js/vendor-all.min.js"></script>
<script src="backend/assets/js/plugins/bootstrap.min.js"></script>

<script src="backend/assets/js/pcoded.min.js"></script>



</body>

</html>
<link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


  
  
  
  
   <script>
    @if(Session::has('success'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.success("{{ session('success') }}");
    @endif

    @if(Session::has('error'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.warning("{{ session('warning') }}");
    @endif
  </script>
