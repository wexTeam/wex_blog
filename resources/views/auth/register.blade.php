@extends('layouts.master')
@section('content')
    @php $setting =\App\Setting::pluck('value','name')->toArray(); @endphp
    <section id="wrapper" class="new-login-register">
        <div class="lg-info-panel">
            <div class="inner-panel">
                <a href="javascript:void(0)" class="p-20 di"><img src="@isset($setting['logo']) {{ asset('uploads/'.$setting['logo']) }}@endisset"></a>
                <div class="lg-content">
                    <h2>@isset($setting['auth_page_heading']) {{ $setting['auth_page_heading'] }}@endisset</h2>
                    <p class="text-muted">@isset($setting['auth_page_desc']) {{ $setting['auth_page_desc'] }}@endisset</p>
                </div>
            </div>
        </div>
        <div class="new-login-box">
            <div class="white-box">
                <h3 class="box-title m-b-0">{{ __('Register') }}</h3>
                <small>Enter your details below</small>
                <form class="form-horizontal new-lg-form generalForm" id="signup-form" method="POST"
                      action="{{ route('register')}}">
                    @csrf
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control @error('name') is-invalid @enderror" name="name" type="text"
                                   placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control @error('email') is-invalid @enderror" id="email" type="email"
                                   placeholder="Email" required autocomplete="email" name="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror</div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           placeholder="Password" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control"
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary p-t-0">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup"> I agree to all <a href="#">Terms</a></label>
                            </div>
                        </div>
                    </div>-->
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                    type="submit">Sign Up
                            </button>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Already have an account? <a href="{{ route('login') }}" class="text-danger
                            m-l-5"><b>Sign In</b></a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('.generalForm').submit(function () {
            $('.white-box').LoadingOverlay("show");
            $("#generalForm").submit();
        });
    </script>

@endsection
