




@extends('layouts.app')
@section('content')





<div class="container login">
    <div class="row justify-content-center">
        <div class="col-md-6 col-12">


            <div class="card bg-secondary mb-3 card-login" id="register">
                <div class="card-header"><i class="fas fa-user-graduate"></i> Reset Password </div>
                <div class="card-body">


                    @if(session('error'))


                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{session('error')}}
                        </div>



                    @endif

                    @if(session('success'))


                    <div class="alert alert-success">

                         {{session('success')}} <a href="{{route('login')}}" class="btn btn-dark btn-sm ml-4 float-right">Login</a>
                        </div>



                    @endif




                    <form method="POST" action="{{ route('forgot.reset') }}">


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

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">

                                    <a href="{{route('login')}}" class="btn btn-primary float-left">
                                        {{ __('Login') }}
                                    </a>

                                    <button type="submit" class="btn btn-success  float-right">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>

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



    });

  }

  var myFunction = function() {
      window.confirmationResult.confirm(document.getElementById("verificationcode").value)
      .then(function(result) {
        console.log(result);
        $("#otp-success").show();
        $("#verify-next").hide();
      }).catch(function(error) {
        console.log(error);
      });
    };


    </script>



@endsection
