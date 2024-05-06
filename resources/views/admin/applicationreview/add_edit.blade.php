@php
    $edit = false;
    if(!empty($application)){
    if($application->id !=''){
    $edit=true;
    }
    }
@endphp


@extends('admin.layouts.master')
@section('title')
{{ __('admin.menu.site') }} :: {{ __('admin.menu.dashboard') }}
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datepicker/bootstrap-datepicker.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/bs-stepper/css/bs-stepper.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/dropzone/min/dropzone.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.css') }}">
@endsection

@section('breadcrumb')
  @include('../admin.layouts.partials.breadcrumb', ['path1' => __('admin.menu.admin'), 'route1' => route('admin.admin') ])
@endsection

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-2">
                    <a href="{{ route('admin.application') }}"
                        class="btn btn-info form-control btn-add-new">
                        <i class="fas fa-backward"></i> <span>{{ __('admin.common.back') }}</span>
                    </a>
                </div>

                <div class="col-sm-10">
                    <h1 class="text-info">
                        @if($edit)
                            <i class="fas fa-bookmark"></i> {{ __('admin.common.update') }}
                            {{ __('admin.menu.application') }}
                            {{ __('admin.common.info') }}
                        @else
                            <i class="fas fa-bookmark"></i> {{ __('admin.common.add') }}
                            {{ __('admin.menu.application') }}
                            {{ __('admin.common.info') }}
                        @endif

                    </h1>
                </div>

            </div>
        </div>
    </section>

    @if(count($errors) || Session::has('success'))

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-0">
                    <div class="col-md-12">
                        @if(count($errors))
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>{{ __('admin.common.error_whoops') }}</strong>
                                {{ __('admin.common.error_heading') }}
                                <br />
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>{{ __('admin.common.success_heading') }}</strong>
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <br>
                    </div>
                </div>
            </div>
        </section>
    @endif


    <form class="form-edit-add" application="form" id="application_entry_form"
        action="{{ !$edit ? route('admin.applicationreview.store') : route('admin.applicationreview.update', $application->id) }}"
        method="POST" enctype="multipart/form-data" autocomplete="off">
        <!-- PUT Method if we are editing -->
        @if($edit)
            <input type="hidden" name="id" value="{{ $application->id }}">
            {{ method_field("PUT") }}
        @endif
        {{ csrf_field() }}

        <section class="content" style="margin-top: -10px;">
            <div class="container-fluid">
                <div class="row">

                    <!-- col start -->
                    <div class="col-md-4">
                        <!-- card start -->
                        <div class="card">

                            <div class="card-header">
                                <!--<h3 class="card-title">DataTable with minimal features & hover style</h3>-->
                            </div>

                            <div class="card-body">

                                @if($edit)
                                    <div class="form-group">
                                        <label for="area_id">{{ __('admin.applicationreview.area') }}<!--<span style="color: red"> * </span>--></label>
                                        <select class="form-control select2" name="area_id" id="area_id" required>
                                            <option value="">{{ __('admin.common.select') }}</option>
                                            @foreach($areas as $key => $item)
                                                <option value="{{ $item->id }}" {{ ($application->area_id == $item->id) ? 'selected' : '' }}>{{ $item->{'title_'. app()->getLocale()} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="area_id">{{ __('admin.applicationreview.area') }} <!--<span style="color: red"> * </span>--></label>
                                        <select class="form-control select2" name="area_id" id="area_id" required>
                                            <option value="">{{ __('admin.common.select') }}</option>
                                            @foreach($areas as $key => $item)
                                                <option value="{{ $item->id }}"
                                                    {{ (old('area_id') == $item->id) ? 'selected' : '' }}>
                                                    {{ $item->{'title_'. app()->getLocale()} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif


                                @if($edit)
                                    <div class="form-group">
                                        <label for="branch_id">{{ __('admin.applicationreview.branch') }} <!--<span style="color: red"> * </span>--></label>
                                        <select class="form-control select2" name="branch_id" id="branch_id" required>
                                            <option value="">{{ __('admin.common.select') }}</option>
                                            @foreach($branches as $key => $item)
                                                <option value="{{ $item->id }}"
                                                    {{ ($application->branch_id == $item->id) ? 'selected' : '' }}>{{ $item->{'title_'. app()->getLocale()} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="branch_id">{{ __('admin.applicationreview.branch') }} <!--<span style="color: red"> * </span>--></label>
                                        <select class="form-control select2" name="branch_id" id="branch_id" required>
                                            <option value="">{{ __('admin.common.select') }}</option>
                                            {{-- @foreach($branches as $key => $item)
                                                <option value="{{ $item->id }}"
                                                    {{ (old('branch_id') == $item->id) ? 'selected' : '' }}>
                                                    {{ $item->{'title_'. app()->getLocale()} }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                @endif


                                @if($edit)
                                    <div class="form-group">
                                        <label for="service_id">{{ __('admin.applicationreview.service') }} <!--<span style="color: red"> * </span>--></label>
                                        <select class="form-control select2" name="service_id" id="service_id" required>
                                            <option value="">{{ __('admin.common.select') }}</option>
                                            @foreach($services as $key => $item)
                                                <option value="{{ $item->id }}"
                                                    {{ ($application->service_id == $item->id) ? 'selected' : '' }}>
                                                    {{ $item->{'title_'. app()->getLocale()} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="service_id">{{ __('admin.applicationreview.service') }} <!--<span style="color: red"> * </span>--></label>
                                        <select class="form-control select2" name="service_id" id="service_id" required>
                                            <option value="">{{ __('admin.common.select') }}</option>
                                            @foreach($services as $key => $item)
                                                <option value="{{ $item->id }}"
                                                    {{ (old('service_id') == $item->id) ? 'selected' : '' }}>
                                                    {{ $item->{'title_'. app()->getLocale()} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="title_en">{{ __('admin.applicationreview.title_en') }}</label>
                                    <input type="text" name="title_en" id="title_en"
                                        placeholder="{{ __('admin.applicationreview.title_en') }}"
                                        value="{{ $edit?$application->title_en:old('title_en') }}"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="title_bn">{{ __('admin.applicationreview.title_bn') }}</label>
                                    <input type="text" name="title_bn" id="title_bn"
                                        placeholder="{{ __('admin.applicationreview.title_bn') }}"
                                        value="{{ $edit?$application->title_bn:old('title_bn') }}"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="contact">{{ __('admin.applicationreview.contact') }}</label>
                                    <input type="text" name="contact" id="contact"
                                        placeholder="{{ __('admin.applicationreview.contact') }}"
                                        value="{{ $edit?$application->contact:old('contact') }}"
                                        class="form-control" minlength="11" maxlength="15" onkeypress='validate(event)'>
                                </div>

                                <div class="form-group">
                                  <label for="passport">{{ __('admin.applicationreview.passport') }}</label>
                                  <input type="text" name="passport" id="passport"
                                      placeholder="{{ __('admin.applicationreview.passport') }}"
                                      value="{{ $edit?$application->passport:old('passport') }}"
                                      class="form-control" minlength="11" maxlength="15" onkeypress='validate(event)'>
                                </div>

                                <div class="form-group">
                                    <label for="dob">{{ __('admin.applicationreview.dob') }} </label>
                                    <input type="text" name="dob" id="dob"
                                        placeholder="{{ __('admin.applicationreview.dob') }}"
                                        value="{{ ($edit)? $application->dob : '' }}"
                                        class="form-control">
                                </div>
                            </div>

                        </div>
                        <!-- card start -->
                    </div>
                    <!-- col end -->

                    <!-- col start -->
                    <div class="col-md-4">
                        <!-- card start -->
                        <div class="card">

                            <div class="card-header">
                                <!--<h3 class="card-title">DataTable with minimal features & hover style</h3>-->
                            </div>

                            <div class="card-body">

                                <div class="form-group">
                                    <label for="email">{{ __('admin.applicationreview.email') }}</label>
                                    <input type="email" name="email" id="email"
                                        placeholder="{{ __('admin.applicationreview.email') }}"
                                        value="{{ $edit?$application->email:old('email') }}"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="nid">{{ __('admin.applicationreview.nid') }}</label>
                                    <input type="text" name="nid" id="nid"
                                        placeholder="{{ __('admin.applicationreview.nid') }}"
                                        value="{{ $edit?$application->nid:old('nid') }}"
                                        class="form-control" minlength="10" maxlength="17" onkeypress='validate(event)'>
                                </div>

                                

                                <div class="form-group">
                                    <label for="title_bn"
                                        style="padding-right:20%;padding-top: 3%;">{{ __('admin.applicationreview.gender') }}
                                        : </label>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="gender" value="1"
                                                {{ ($edit && ($application->gender)) ? 'checked' : '' }}>{{ __('admin.applicationreview.male') }}
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="gender" value="0"
                                                {{ ($edit && (!$application->gender)) ? 'checked' : '' }}>{{ __('admin.applicationreview.female') }}
                                        </label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="title_bn"
                                        style="padding-right:8%;padding-top: 3%;">{{ __('admin.applicationreview.marital') }}: </label>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="marital" value="1"
                                                {{ ($edit && ($application->marital)) ? 'checked' : '' }}>{{ __('admin.applicationreview.married') }}
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="marital" value="0"
                                                {{ ($edit && (!$application->marital)) ? 'checked' : '' }}>{{ __('admin.applicationreview.unmarried') }}
                                        </label>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- card start -->
                    </div>
                    <!-- col end -->


                    <!-- col start -->
                    <div class="col-md-4">
                        <!-- card start -->
                        <div class="card">

                            <div class="card-header">
                                <!--<h3 class="card-title">DataTable with minimal features & hover style</h3>-->
                            </div>

                            <div class="card-body">

                              <div class="form-group">
                                    <label
                                        for="address_en">{{ __('admin.applicationreview.address_en') }}</label>
                                    <textarea rows="1" id="address_en" class="form-control"
                                        placeholder="{{ __('admin.applicationreview.address_en') }}"
                                        name="address_en"
                                        required>{{ $edit?$application->address_en:old('address_en') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label
                                        for="address_bn">{{ __('admin.applicationreview.address_bn') }}</label>
                                    <textarea rows="1" id="address_bn" class="form-control"
                                        placeholder="{{ __('admin.applicationreview.address_bn') }}"
                                        name="address_bn"
                                        required>{{ $edit?$application->address_bn:old('address_bn') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label
                                        for="father_en">{{ __('admin.applicationreview.father_en') }}</label>
                                    <input type="text" name="father_en" id="father_en"
                                        placeholder="{{ __('admin.applicationreview.father_en') }}"
                                        value="{{ $edit?$application->father_en:old('father_en') }}"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label
                                        for="father_bn">{{ __('admin.applicationreview.father_bn') }}</label>
                                    <input type="text" name="father_bn" id="father_bn"
                                        placeholder="{{ __('admin.applicationreview.father_bn') }}"
                                        value="{{ $edit?$application->father_bn:old('father_bn') }}"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label
                                        for="spouse_en">{{ __('admin.applicationreview.spouse_en') }}</label>
                                    <input type="text" name="spouse_en" id="spouse_en"
                                        placeholder="{{ __('admin.applicationreview.spouse_en') }}"
                                        value="{{ $edit?$application->spouse_en:old('spouse_en') }}"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label
                                        for="spouse_bn">{{ __('admin.applicationreview.spouse_bn') }}</label>
                                    <input type="text" name="spouse_bn" id="spouse_bn"
                                        placeholder="{{ __('admin.applicationreview.spouse_bn') }}"
                                        value="{{ $edit?$application->spouse_bn:old('spouse_bn') }}"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="dsign">
                                        {{ __('admin.applicationreview.dsign') }} <span
                                            class="text-warning">
                                            ({{ __('admin.common.file_size_100') }})</span>
                                    </label>
                                    <input style="padding-top: 4px;" type="file" name="dsign" id="dsign"
                                        class="form-control">
                                    @if($edit && $application->dsign)
                                        <a target="_blank"
                                            href="{{ asset('storage/'.$application->dsign) }}">Show</a>
                                    @endif
                                </div>


                                {{-- @if($edit)
                                    <div class="form-group">
                                        <label for="approval_id">{{ __('admin.applicationreview.approval') }}<!--<span style="color: red"> * </span>--></label>
                                        <select class="form-control select2" name="approval_id" id="approval_id" required>
                                            <option value="">{{ __('admin.common.select') }}</option>
                                            @foreach($approvals as $key => $item)
                                                <option value="{{ $item->id }}" {{ ($application->approval_id == $item->id) ? 'selected' : '' }}>{{ $item->{'title_'. app()->getLocale()} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="approval_id">{{ __('admin.applicationreview.approval') }} <!--<span style="color: red"> * </span>--></label>
                                        <select class="form-control select2" name="approval_id" id="approval_id" required>
                                            <option value="">{{ __('admin.common.select') }}</option>
                                            @foreach($approvals as $key => $item)
                                                <option value="{{ $item->id }}"
                                                    {{ (old('approval_id') == $item->id) ? 'selected' : '' }}>
                                                    {{ $item->{'title_'. app()->getLocale()} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif --}}

                            </div>
                        </div>
                        <!-- card start -->
                    </div>
                    <!-- col end -->




                    <!-- col start -->
                    <div class="col-md-8">
                        <!-- card start -->
                        <div class="card">

                            <div class="card-header">
                                <!--<h3 class="card-title">DataTable with minimal features & hover style</h3>-->
                            </div>

                            <div class="card-body">
                                @if ($edit)
                                    @if (count($application->file) > 0 )
                                        @foreach ($application->file as $key=>$file)
                                        <input type="hidden" name="arraydata[file{{$key+1}}][id]" value="{{$file->id}}">
                                        <div class="row">
                                            <div class="col-md-5">
                                            <div class="form-group">
                                                <input type="text" name="arraydata[file{{$key+1}}][name]" id="name{{$key+1}}" placeholder="File Title" value="{{$file->name}}" class="form-control">
                                            </div>
                                            </div>
                                            <div class="col-md-5">
                                            <div class="form-group">
                                                <input style="padding-top: 4px;" type="file" name="arraydata[file{{$key+1}}][thumb]" id="thumb{{$key+1}}" class="form-control">
                                                <a target="_blank" href="{{ asset('storage/'.$file->thumb) }}">Show</a>
                                            </div>
                                            </div>
                                            <div class="col-md-2">
                                            <div class="form-group">
                                                {{-- <button disabled id="delete0" class="delete btn btn-danger btn-round form-control"><span> <i class="fa fa-minus" aria-hidden="true"></i></span> </button> --}}
                                                <a style="margin-top: 7px;" href="{{ route('admin.application_file.delete', $file->id) }}" href1="{{ route('admin.application_file.delete', [$file->id,1]) }}" class="btn btn-xs btn-danger deletes"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                            </div>
                                        </div>  
                                        @endforeach  
                                    @else
                                        <div class="row">
                                            <div class="col-md-5">
                                            <div class="form-group">
                                                <input type="text" name="arraydata[file1][name]" id="name" placeholder="File Title" value="" class="form-control">
                                            </div>
                                            </div>
                                            <div class="col-md-5">
                                            <div class="form-group">
                                                <input style="padding-top: 4px;" type="file" name="arraydata[file1][thumb]" id="thumb" class="form-control">
                                            </div>
                                            </div>
                                            <div class="col-md-2">
                                            <div class="form-group">
                                                <button disabled id="delete0" class="delete btn btn-danger btn-round form-control"><span> <i class="fa fa-minus" aria-hidden="true"></i></span> </button>
                                            </div>
                                            </div>
                                        </div>    
                                    @endif
                                @else
                                    <div class="row">
                                        <div class="col-md-5">
                                        <div class="form-group">
                                            <input type="text" name="arraydata[file1][name]" id="name" placeholder="File Title" value="" class="form-control">
                                        </div>
                                        </div>
                                        <div class="col-md-5">
                                        <div class="form-group">
                                            <input style="padding-top: 4px;" type="file" name="arraydata[file1][thumb]" id="thumb" class="form-control">
                                        </div>
                                        </div>
                                        <div class="col-md-2">
                                        <div class="form-group">
                                            <button disabled id="delete0" class="delete btn btn-danger btn-round form-control"><span> <i class="fa fa-minus" aria-hidden="true"></i></span> </button>
                                        </div>
                                        </div>
                                    </div>    
                                @endif
                                
                                <div class="append_area"></div>

                                <div class="row">
                                    <div class="col-md-8"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <a onclick="return false;"
                                                class="add_form_field btn btn-primary btn-round form-control" href="#">
                                                {{ __('admin.common.add_more') }} &nbsp; <i
                                                    class="fa fa-plus" aria-hidden="true"></i></a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-- card start -->
                    </div>
                    <!-- col end -->


                    <!-- col start -->
                    <div class="col-md-4">
                        <!-- card start -->
                        <div class="card">

                            <div class="card-header">
                                <!--<h3 class="card-title">DataTable with minimal features & hover style</h3>-->
                            </div>

                            <div class="card-body">

                                <div class="form-group">
                                    <button type="submit" class="btn btn-info btn-sm form-control save">
                                        <i class="fas fa-save"></i> {{ __('admin.common.save') }}
                                    </button>
                                </div>


                            </div>
                        </div>
                        <!-- card start -->
                    </div>
                    <!-- col end -->
                </div>
            </div>
        </section>
    </form>

</div>




@endsection


@section('scripts')
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script
    src="{{ asset('assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}">
</script>
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>

<script src="{{ asset('assets/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

<script
    src="{{ asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}">
</script>
<script
    src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
</script>

<script src="{{ asset('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}">
</script>
<script src="{{ asset('assets/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/dropzone/min/dropzone.min.js') }}"></script>



<script>
    function validate(evt) {
        var theEvent = evt || window.event;
        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault) theEvent.preventDefault();
        }
    }

    $(document).ready(function () {
        // Validation

        $(window).bind('keydown', function (e) {
            var key = e.which;
            // console.log(key);
        });

        $sender_contact = $('#contact');
        senderContact();

        function senderContact() {
            $($sender_contact).keyup(function (e) {
                let value = $(this).val();
                if (value.length == 11) {
                    $(this).removeClass('is-invalid');
                    $(this).css("background", "none");
                } else {
                    $(this).addClass('is-invalid');
                }
            });
        }

        // Validation


        $('.select2').select2();
        //Timepicker
        $('#receive_time').datetimepicker({
            format: 'LT'
        })

        $("#dob").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd',
            //startDate: '-3d'
        }).datepicker(@if($edit && @$application -> dob) @else 'update', new Date() @endif);



        // Add more area

        var max_fields = 20;
        var wrapper = $(".append_area");
        var add_button = $(".add_form_field");

        @if ($edit)
            @if (count($application->file) > 0)
                let x = {{count($application->file)}}; 
            @else
                let x = 1;
            @endif
        @else
            let x = 1;
        @endif
        

        $(add_button).click(function (e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append('<div class="row">' +
                    '<div class="col-md-5">' +
                      '<div class="form-group">' +
                        '<input type="text" name="arraydata[file'+ x +'][name]" id="name'+ x +'" placeholder="{{ __('admin.applicationreview.file_title') }}" value="" class="form-control">' +
                      '</div>' +
                    '</div>' +
                    '<div class="col-md-5">' +
                      '<div class="form-group">' +
                        '<input style="padding-top: 4px;" type="file" name="arraydata[file'+ x +'][thumb]" id="thumb'+ x +'" class="form-control">' +
                      '</div>' +
                    '</div>' +
                    '<div class="col-md-2">' +
                      '<div class="form-group">' +
                        '<button id="delete'+ x +'" class="delete btn btn-danger btn-round form-control"><span> <i class="fa fa-minus" aria-hidden="true"></i></span></button>' +
                      '</div>' +
                    '</div>' +
                  '</div>');
            } else {
                alert('You Reached the limits')
            }
        });


        $(wrapper).on("click", ".delete", function (e) {
            e.preventDefault();
            $(this).parent('div').parent('div').parent('div').remove();
            x--;

        })



        $('#area_id').on('change', function(e){
            var area_id = e.target.value;
            var route = "{{route('get.branch_by_area')}}/"+area_id;
            //console.log(area_id);
            $.get(route, function(data) {
            //console.log(data);
            $('#branch_id').empty();
            $('#branch_id').append('<option value="">{{ __('admin.common.select') }} {{ __('admin.user.branch') }}</option>');
            $.each(data, function(index,data){
                $('#branch_id').append('<option value="' + data.id + '">' + data.title_{{app()->getLocale()}} + ' - ' + data.code +  '</option>');
            });
            });
        });



        $(document, 'td').on('click', '.deletes', function (e) {
            e.preventDefault();
            //console.log($(this).attr('href'))
            var route = $(this).attr('href');
            var route1 = $(this).attr('href1');
            //console.log(route, route1);
            //return false;

            Swal.fire({
            title: "{{__('admin.common.confirm_msg')}}",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Soft Delete',
            denyButtonText: `Force Delete`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                //Soft Delete
                window.location.href = route;
            } else if (result.isDenied) {
                //Force Delete
                window.location.href = route1;
            }
            })
        });


    });

</script>


@endsection
