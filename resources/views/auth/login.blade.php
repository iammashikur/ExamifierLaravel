




@extends('layouts.app')
@section('content')





<div class="container login">
    <div class="row justify-content-center">
        <div class="col-md-6 col-12">


            <div class="card bg-secondary mb-3 card-login" id="login">
                <div class="card-header"><i class="fas fa-user-graduate"></i> Student Login <button onclick="register()" type="button" class="btn btn-secondary btn-sm float-right register-btn"><i class="fas fa-plus"></i> REGISTER</button></div>
                <div class="card-body">

                    <form class="login-form"  method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">





                            <input placeholder="phone" id="phone2" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror




                        </div>
                        <div class="form-group">

                            <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group form-check">
                            <label class="form-check-label">
                            <input class="form-check-input" type="checkbox"> Remember me
                          </label>
                        </div>
                    <a href="{{route('forgot')}}" class="btn btn-warning float-left btn-sm login-btn">
                            <i class="fas fa-sign-in-alt"></i> Forgot?
                        </a>

                        <button type="submit" class="btn btn-success float-right btn-sm login-btn">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>

                    </form>
                </div>
            </div>


            <div class="card bg-secondary mb-3 card-login" id="register" style="display: none;">
                <div class="card-header"><i class="fas fa-user-graduate"></i> Student Register <button onclick="login()" type="button" class="btn btn-secondary btn-sm float-right register-btn"><i class="fas fa-sign-in-alt"></i> LOGIN</button></div>
                <div class="card-body">

                    {{-- <form class="login-form" action="student.html">
                        <div class="form-group">

                            <input type="phone" class="form-control" placeholder="Enter phone" id="phone">
                        </div>

                        <div class="form-group">

                            <input type="phone" class="form-control" placeholder="Enter phone" id="phone">
                        </div>

                        <div class="form-group">

                            <input type="phone" class="form-control" placeholder="Enter phone" id="phone">
                        </div>

                        <div class="form-group">

                            <input type="password" class="form-control" placeholder="Enter password" id="pwd">
                        </div>
                        <div class="form-group form-check">
                            <label class="form-check-label">
                            <input class="form-check-input" type="checkbox"> Remember me
                          </label>
                        </div>
                        <button type="submit" class="btn btn-primary float-right btn-sm login-btn">
                            <i class="fas fa-plus"></i> REGISTER
                        </button>
                    </form> --}}


                    <form method="POST" action="{{ route('register') }}">
                        @csrf


                        <div id="otp">

                            <div class="form-group row" id="phone-input">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                <div class="col-md-6">


                                    <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>


                            <div id="verify" style="display: none;">


                                <div class="form-group row" id="phone-input">
                                    <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Verification Code') }}</label>

                                    <div class="col-md-6">

                                        <input id="verificationcode" type="text" class="form-control" id="verificationcode">


                                    </div>
                                </div>


                            </div>

                            <center>

                                <div id="recaptcha-container"></div>

                            </center>












                        </div>



                        <div style="display:none" id="otp-success">

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                                    <button type="submit" class="btn btn-primary float-right login-btn">
                                        {{ __('Register') }}
                                    </button>

                        </div>



                        <button id="next" class="btn btn-success float-right btn-sm login-btn" type="button" onclick="Otp()"> Next </button>

                        <button id="verify-next" class="btn btn-success float-right btn-sm login-btn" type="button" onclick="myFunction()"> Verify </button>




                    </form>


                </div>
            </div>



        </div>
    </div>
</div>

<script>
    function register() {
        $("#login").hide();
        $("#register").show();
    }

    function login() {
        $("#register").hide();
        $("#login").show();
    }
</script>

<script src="https://www.gstatic.com/firebasejs/4.8.1/firebase.js"></script>
    <script type="text/javascript">
    // Initialize Firebase
    var config = {
      apiKey: "AIzaSyB7jtEQ3fB_LNp8vkbzfrfaRlWzibvk8mw",
      authDomain: "doctor-d7f77.firebaseapp.com",
      databaseURL: "https://doctor-d7f77.firebaseio.com",
      projectId: "doctor-d7f77",
      storageBucket: "doctor-d7f77.appspot.com",
      messagingSenderId: "769371697772"
    };
    firebase.initializeApp(config);
  </script>
  <script type="text/javascript">

$("#verify-next").hide();

  function Otp()
  {


    $("#phone-input").hide();
    var Phone = $("#phone").val();
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
    firebase.auth().signInWithPhoneNumber('+880'+Phone , window.recaptchaVerifier)
    .then(function(confirmationResult) {
      window.confirmationResult = confirmationResult;
      console.log(confirmationResult);

      $("#verify").show();
      $("#next").hide();
      $("#verify-next").show();
      $("#recaptcha-container").hide();


    });

  }

  var myFunction = function() {
      window.confirmationResult.confirm(document.getElementById("verificationcode").value)
      .then(function(result) {
        console.log(result);
        $("#otp-success").show();
        $("#verify-next").hide();
        $("#verify").hide();
      }).catch(function(error) {
        console.log(error);
      });
    };


    </script>



@endsection
