@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Settings</h4></div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="active">Update Setting</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    @include('admin.partials._msg')
                    <h3 class="box-title m-b-0">Edit Settings</h3>
                    <form class="form-horizontal" method="POST" action="{{ route('setting.store') }}"
                          enctype='multipart/form-data'>
                        @csrf
                        @foreach($all_columns as $column)
                            @if($column['type']=="file")
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{{$column['label']}}</label>
                                    <div class="col-sm-6">
                                    <?php
                                    if(isset($settings[$column['name']])){
                                        $settings[$column['name']] = $settings[$column['name']];
                                    }else {
                                        $settings[$column['name']]='abc.png';
                                    }
                                    ?>
                                    <input type="file" name="{{$column['name']}}" class="{{$column['class']}}" id="{{$column['id']}}">
                                    @if(File::exists('uploads/'.$settings[$column['name']]))
                                        <img src="{{asset('uploads/'.$settings[$column['name']])}}" style="{{$column['style']}}" alt="{{$column['name']}} is not found" />
                                    @else
                                        <img src="{{asset('uploads/img.png')}}" style="{{$column['style']}}" alt="{{$column['name']}} is not found"/>
                                    @endif
                                    </div>
                                </div>
                            @endif

                            @if($column['type']=="text")
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{{$column['label']}}</label>
                                    <div class="col-sm-6">
                                    <input type="text" name="{{$column['name']}}" placeholder="{{$column['place_holder']}}" value="{{ isset($settings[$column['name']]) ? $settings[$column['name']] : ''}}" class="{{$column['class']}}" id="{{$column['id']}}">
                                    </div>
                                    </div>
                            @endif
                            @if($column['type']=="hidden")

                                <input type="hidden" name="{{$column['name']}}" value="{{ isset
                          ($settings[$column['name']]) ? $settings[$column['name']]: ''}}">

                            @endif
                            @if($column['type']=="textarea")
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{{$column['label']}}</label>
                                    <div class="col-sm-6">
                                    <textarea name="{{$column['name']}}" class="{{$column['class']}}"
                                              rows="{{isset($column['rows'] )? $column['rows'] :'2'}}"
                                              placeholder="{{$column['place_holder']}}" id="{{$column['id']}}">{{ isset($settings[$column['name']]) ? $settings[$column['name']] : ''}}</textarea>
                                </div>
                                </div>
                            @endif
                            @if($column['type']=="checkbox")
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{{$column['label']}}</label>
                                    <div class="col-sm-6">
                                    <div class="span3">
                                        <label>
                                            <input type="checkbox" name="{{$column['name']}}" class="{{$column['class']}}" <?php if (isset($settings[$column['name']]) and $settings[$column['name']] == "1"){ echo "checked"; } ?>  id="{{$column['id']}}" data-color="#13dafe" data-size="small" />

                                            <span class="lbl"></span>
                                        </label>
                                    </div>
                                    </div>

                                </div>
                            @endif
                        @endforeach
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