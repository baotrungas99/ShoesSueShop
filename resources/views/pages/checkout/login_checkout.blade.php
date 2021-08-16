@extends('layout')
@section('content')
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
                        @if(session()->has('message'))
                                    <div  class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @elseif(session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session()->get('error') }}
                                    </div>
                                @endif
						<form action="{{URL::to('/login-customer')}}" method="post">
                        {{csrf_field()}}
							<input type="text" name="email_account" placeholder="Your Account" />
							<input type="password" name="password_account" placeholder="Password" />
							<span>
								<input type="checkbox" class="checkbox">
								Keep me signed in
							</span>
							<button type="submit" class="btn btn-default">Login</button>
						</form><br>
                        <a href="{{url('/login-facebook-customer')}}">Login Facebook</a> |
                        <a href="{{url('/login-google-customer')}}">Login Google</a>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="{{URL::to('/add-customer')}}" method="post">
                        {{csrf_field()}}
							<input type="text" name="cus_name" placeholder="Your Name"required/>
							<input type="email"name="cus_email" placeholder="Email Address"required/>
							<input type="password" name="cus_pass" placeholder="Password"required/>
                            <input type="text"name="cus_phone" placeholder="Phone number"required/>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection
