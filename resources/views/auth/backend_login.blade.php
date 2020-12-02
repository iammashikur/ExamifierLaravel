@extends('layouts.app')

@section('content')


<div class="container login">
    <div class="row justify-content-center">
        <div class="col-md-6 col-12">


            <div class="card bg-secondary border-secondary mb-3 card-login" id="examiniee">
                <div class="card-header"><i class="fas fa-award"></i> Examiner Login <button onclick="admin()" type="button" class="btn btn-secondary btn-sm float-right register-btn"><i class="fas fa-atom"></i> Admin Login</button></div>
                <div class="card-body">

                    <form class="login-form"  method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">



                            <input placeholder="Email" id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

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
                        <button type="submit" class="btn btn-success float-right btn-sm login-btn">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                    </form>
                </div>
            </div>

            <div class="card border-primary mb-3 card-login" id="admin" style="display: none;">
                <div class="card-header"><i class="fas fa-atom"></i> Admin Login <button onclick="examiniee()" type="button" class="btn btn-secondary btn-sm float-right register-btn"><i class="fas fa-award"></i> Examinnie Login</button></div>
                <div class="card-body">

                    <form class="login-form"  method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">



                            <input placeholder="Email" id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

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
                        <button type="submit" class="btn btn-success float-right btn-sm login-btn">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>

<script>
    function admin() {
        $("#examiniee").hide();
        $("#admin").show();
    }

    function examiniee() {
        $("#admin").hide();
        $("#examiniee").show();
    }
</script>





@endsection
