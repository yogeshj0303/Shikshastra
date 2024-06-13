@extends('Front-end.layout.main')
@section('main.container')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verify-otp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <style>body {
	/*background: var(--bs-dark);*/
}

.otp-form .otp-field {
	display: inline-block;
	width: 4rem;
	height: 4rem;
	font-size: 2rem;
	line-height: 4rem;
	text-align: center;
	border: none;
	border-bottom: 2px solid var(--bs-secondary);
	outline: none;
}

.otp-form .otp-field:focus {
	border-bottom-color: var(--bs-dark);
}
</style>
</head>
<body>
    <div class="container">
	<div class="row justify-content-center align-items-center vh-100">
		<div class="card col-12 col-md-8 col-lg-7 p-4">
			<div class="card-body">
				<h4 class="card-title text-center">OTP Verificattion</h4>
				                                 <h3>@if(session()->has('message'))
                                   <div class="alert alert-success">
                                  {{ session()->get('message') }}
                                          </div>
                                     @endif
                                     @if(session()->has('error'))
                                   <div class="alert alert-danger">
                                  {{ session()->get('error') }}
                                          </div>
                                     @endif</h3>
				<div class="card-text text-center mt-5">
					<form action="/verify_employee" class="otp-form" method="post">
					    @csrf
					    	<input type="text" name="email" value="{{$email}}" hidden>
					<div class="d-block "><input   type="text" name="opt_field"  style="width:100px; " required>
					
					</div>
					


					
						
						<div class="d-block mt-4">
							<button class="btn btn-primary" type="submit">Verify</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
@endsection