@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Profile</h4></div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="active">Update Profile</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    @include('admin.partials._msg')
                    <h3 class="box-title m-b-0">Edit Profile</h3>
                    <form class="form-horizontal" method="post" action="{{ route('admin-update') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-4">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       required autocomplete="name" value="{{ $admin->name }}" autofocus id="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-4">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ $admin->email }}" required autocomplete="email" autofocus id="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                       placeholder="if you won't change password, leave it empty.."
                                       autocomplete="current-password" id="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <div class="form-group m-b-0">
                            <div class="col-sm-offset-3 col-sm-4 text-center">
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-info waves-effect waves-light
                                 m-t-10"><i class="fa fa-backward"></i> Back</a>
                                <button type="submit" class="btn btn-success waves-effect waves-light m-t-10">
                                    <i class="fa fa-check"></i> Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
@endsection
