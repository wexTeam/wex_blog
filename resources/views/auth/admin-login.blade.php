@extends('layouts.master')
@section('content')
    @php $setting =\App\Setting::pluck('value','name')->toArray(); @endphp
    <section id="wrapper" class="new-login-register">
        <div class="lg-info-panel">
            <div class="inner-panel">
                <a href="javascript:void(0)" class="p-20 di">
                    <img src="@isset($setting['logo']) {{ asset('uploads/'.$setting['logo']) }}@endisset">
                </a>
                <div class="lg-content">
                    <h2>@isset($setting['auth_page_heading']) {{ $setting['auth_page_heading'] }}@endisset</h2>
                    <p class="text-muted">@isset($setting['auth_page_desc']) {{ $setting['auth_page_desc'] }}@endisset</p>
                </div>
            </div>
        </div>
        <div class="new-login-box">
            <div class="white-box">
                <h3 class="box-title m-b-0">Sign In to Admin</h3>
                <small>Enter your details below</small>
                <form class="form-horizontal new-lg-form generalForm"
                      id="loginform" method="POST" action="{{ route('admin.login.submit') }}">
                    @csrf
                    <div class="form-group  m-t-20">
                        <div class="col-xs-12">
                            <label>{{ __('E-Mail Address') }}</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                                   value="{{
                            old('email') }}" placeholder="Email Address" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label>{{ __('Password') }}</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password"
                                   name="password"
                                   required="" placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-info pull-left p-t-0">
                                <input id="checkbox-signup" name="remember"
                                       type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <label for="checkbox-signup"> Remember me </label>
                            </div>
                            <a href="{{ route('admin.password.request') }}" class="text-dark pull-right"><i
                                        class="fa fa-lock m-r-5"></i> Forgot pwd?</a></div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light"
                                    type="submit">Log In
                            </button>
                        </div>
                    </div>

                <!-- <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Don't have an account? <a href="{{ route('register') }}" class="text-primary m-l-5"><b>Sign Up</b></a></p>
                        </div>
                    </div> -->
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
