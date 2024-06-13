<!DOCTYPE html>
<html lang="en" class="h-100">


<!-- Mirrored from koki.dexignzone.com/xhtml/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Mar 2022 06:08:47 GMT -->
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="admin, dashboard" />
	<meta name="author" content="DexignZone" />
	<meta name="robots" content="index, follow" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Koki :  Restaurant Admin Dashboard  Bootstrap 5 Template" />
	<meta property="og:title" content="Koki :  Restaurant Admin Dashboard  Bootstrap 5 Template" />
	<meta property="og:description" content="Koki :  Restaurant Admin Dashboard  Bootstrap 5 Template" />
	<meta property="og:image" content="social-image.png"/>
	<meta name="format-detection" content="telephone=no">
    <title>Spires -  Reset Password</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets1/images/logo.png')}}">
    <link href="{{ asset('assets1/css/style.css')}}" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="index.html"><img src="{{ asset('assets1/images/logo.png')}}" alt="" style="width: 117px;"></a>
									</div>
                                    <h4 class="text-center mb-4">Reset Your Password</h4>
                                    <label> <p class="text text-danger">@if (session()->has('message'))
                                        {{session()->get('message')}}
                                      @endif</p></label>
                                      <label> <p class="text text-success">@if (session()->has('success'))
                                        {{session()->get('success')}}
                                      @endif</p></label>
<form action="{{ route('resetpassword') }}" method="post">
    @csrf
    <input type="hidden" name="email" value="{{ $user->email }}">
    <input type="hidden" name="token" value="{{ $tokendata }}">
    <input type="password" name="password" placeholder="New Password" required>
    <!-- Other form fields if needed -->
    <button type="submit">Reset Password</button>
</form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('assets1/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('assets1/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets1/js/deznav-init.js') }}"></script>

</body>


<!-- Mirrored from koki.dexignzone.com/xhtml/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Mar 2022 06:08:48 GMT -->
</html>
