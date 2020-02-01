@extends('layouts/default')

{{-- Page title --}}
@section('title')
    {{ trans('general.import-history') }}
    @parent
@stop

@section('header_right')
    <a href="{{ route('hardware.index') }}" class="btn btn-default"> {{ trans('general.back') }}</a>
@stop

{{-- Page content --}}
@section('content')


    @if (isset($status))

        @if (count($status['error']) > 0)
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-default">
                        <div class="alert alert-danger">
                            <i class="fa fa-exclamation-circle faa-pulse animated"></i>
                            <strong>{{ count($status['error']) }} Error Messagess: </strong>
                            Please see below for errors.
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-default">
                    <div class="alert alert-success">
                        <i class="fa fa-check faa-pulse animated"></i>
                        <strong>{{ count($status['success']) }} Success Messages: </strong>
                        Please see below for details.
                    </div>
                </div>
            </div>
        </div>

        @endif

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-default">
                <div class="box-body">
                    <div class="col-md-12">
                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="">
                        <!-- CSRF Token -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        @if (Session::get('message'))
                            <p class="alert-danger">
                                You have an error in your CSV file:<br />
                                {{ Session::get('message') }}
                            </p>
                        @endif

                        <p>
                            {{ trans('admin/hardware/general.Upload_a_CSV_that_contains_asset_history.') }}
                        </p>

                        <p>{{ trans('admin/hardware/general.Fields_included_in_the_CSV_must_match_the_headers') }} <strong>Asset Tag, Checkout Date, Checkin Date, Name</strong>.{{ trans('admin/hardware/general.Any_additional_fields_will_be_ignored') }} </p>


                        <p><strong>{{ trans('admin/hardware/general.History_should_be_ordered_by_date_in_ascending_order.') }}</strong></p>

                        <div class="form-group">
                            <label for="first_name" class="col-sm-3 control-label">{{ trans('admin/users/general.usercsv') }}</label>
                            <div class="col-sm-9">
                                <input type="file" name="user_import_csv" id="user_import_csv"{{ (config('app.lock_passwords')===true) ? ' disabled' : '' }}>
                            </div>
                        </div>




                <!-- Match firstname.lastname -->
                <div class="form-group">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-10">
                        {{ Form::checkbox('match_firstnamelastname', '1', Input::old('match_firstnamelastname')) }} {{ trans('admin/hardware/general.Try_to_match_users_by_firstname.lastname_(ghader.ansari)_format') }}
                    </div>
                </div>

                <!-- Match flastname -->
                <div class="form-group">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-10">
                        {{ Form::checkbox('match_flastname', '1', Input::old('match_flastname')) }} {{ trans('admin/hardware/general.Try_to_match_users_by_first_initial_last_name_(ansari)_format') }}
                    </div>
                </div>

                <!-- Match firstname -->
                <div class="form-group">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-10">
                        {{ Form::checkbox('match_firstname', '1', Input::old('match_firstname')) }} {{ trans('admin/hardware/general.Try_to_match_users_by_first_name_(ghader)_format') }}
                    </div>
                </div>

                <!-- Match email -->
                <div class="form-group">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-10">
                        {{ Form::checkbox('match_email', '1', Input::old('match_email')) }} {{ trans('admin/hardware/general.Try_to_match_users_by_email_as_username') }}
                    </div>
                </div>


               </div>



        </div>

    <!-- Form Actions -->
    <div class="box-footer text-right">
        @if (config('app.lock_passwords')===true)
            <div class="col-md-12">
                <div class="callout callout-info">
                    {{ trans('general.feature_disabled') }}
                </div>
            </div>

        @else
            <button type="submit" class="btn btn-default">{{ trans('button.submit') }}</button>
         @endif
    </div>

</form>

 </div>

            @if (isset($status))


                @if (count($status['error']) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title"> {{ count($status['error']) }} Error Messages </h3>
                            </div>
                            <div class="box-body">
                                <div style="height : 400px; overflow : auto;">
                                    <table class="table">
                                        @for ($x = 0; $x < count($status['error']); $x++)
                                            @foreach($status['error'][$x] as $object_type => $message)
                                            <tr class="danger">
                                                <td><strong>{{ ucwords($object_type)  }} {{ key($message)  }}:</strong></td>
                                                <td>{{ $message[key($message)]['msg']  }}</td>
                                            </tr>
                                            @endforeach
                                        @endfor
                                    </table>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endif

                @if (count($status['success']) > 0)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-default">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"> {{ count($status['success']) }} Success Messages </h3>
                                    </div>
                                    <div class="box-body">
                                        <div style="height : 400px; overflow : auto;">
                                            <table class="table">
                                                @for ($x = 0; $x < count($status['success']); $x++)
                                                    @foreach($status['success'][$x] as $object_type => $message)
                                                        <tr class="success">
                                                            <td><strong>{{ ucwords($object_type)  }} {{ key($message)  }}:</strong></td>
                                                            <td>{{ $message[key($message)]['msg']  }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endfor
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif
            @endif

        </div></div></div>
<script nonce="{{ csrf_token() }}">
$(document).ready(function(){

    $('#generate-password').pGenerator({
        'bind': 'click',
        'passwordElement': '#password',
        'displayElement': '#password-display',
        'passwordLength': 10,
        'uppercase': true,
        'lowercase': true,
        'numbers':   true,
        'specialChars': false,

    });
});

</script>
@stop
