@extends('layouts/default')

{{-- Page title --}}
@section('title')
{{ trans('general.changepassword') }}
@stop

{{-- Account page content --}}
@section('content')


<div class="row">
    <div class="col-md-9">
    {{ Form::open(['method' => 'POST', 'files' => true, 'class' => 'form-horizontal', 'autocomplete' => 'off']) }}
    <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="box box-default">
            <div class="box-body">


    <!-- Old Password -->
    <div class="form-group {{ $errors->has('current_password') ? ' has-error' : '' }}">
        <label for="current_password" class="col-md-3 control-label">{{ trans('passwords.Current_Password') }}
        </label>
        <div class="col-md-5 required">
            <input class="form-control" type="password" name="current_password" id="current_password" {{ (config('app.lock_passwords') ? ' disabled' : '') }}>
            {!! $errors->first('current_password', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-3 control-label">{{ trans('passwords.New_Password') }}</label>
        <div class="col-md-5 required">
            <input class="form-control" type="password" name="password" id="password" {{ (config('app.lock_passwords') ? ' disabled' : '') }}>
            {!! $errors->first('password', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
        </div>
    </div>


    <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label for="password_confirm" class="col-md-3 control-label">{{ trans('passwords.New_Password_repeat') }}</label>
        <div class="col-md-5 required">
            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation"  {{ (config('app.lock_passwords') ? ' disabled' : '') }}>
            {!! $errors->first('password_confirmation', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
            @if (config('app.lock_passwords'))
            	<p class="help-block">{{ trans('admin/users/table.lock_passwords') }}</p>
            @endif
        </div>
    </div>



            </div> <!-- .box-body -->
            <div class="box-footer text-right">
                <a class="btn btn-link" href="{{ URL::previous() }}">{{ trans('button.cancel') }}</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-check icon-white"></i> {{ trans('general.save') }}</button>
            </div>

        </div> <!-- .box-default -->
        {{ Form::close() }}
    </div> <!-- .col-md-9 -->
</div> <!-- .row-->
@stop
