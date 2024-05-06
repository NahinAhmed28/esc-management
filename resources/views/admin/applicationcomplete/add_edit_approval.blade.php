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
        action="{{ !$edit ? route('admin.applicationdeclined.store') : route('admin.applicationdeclined.update_approval', $application->id) }}"
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
                    <div class="col-md-6">
                        <!-- card start -->
                        <div class="card">

                            <div class="card-header">
                                <!--<h3 class="card-title">DataTable with minimal features & hover style</h3>-->
                            </div>

                            <div class="card-body">

                                @if($edit)
                                    <div class="form-group">
                                        <label for="approval_id">{{ __('admin.applicationdeclined.approval') }}<!--<span style="color: red"> * </span>--></label>
                                        <select class="form-control select2" name="approval_id" id="approval_id" required>
                                            <option value="">{{ __('admin.common.select') }}</option>
                                            @foreach($approvals as $key => $item)
                                                <option value="{{ $item->id }}" {{ ($application->approval_id == $item->id) ? 'selected' : '' }}>{{ $item->{'title_'. app()->getLocale()} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="approval_id">{{ __('admin.applicationdeclined.approval') }} <!--<span style="color: red"> * </span>--></label>
                                        <select class="form-control select2" name="approval_id" id="approval_id" required>
                                            <option value="">{{ __('admin.common.select') }}</option>
                                            @foreach($approvals as $key => $item)
                                                <option value="{{ $item->id }}"
                                                    {{ (old('approval_id') == $item->id) ? 'selected' : '' }}>
                                                    {{ $item->{'title_'. app()->getLocale()} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <!-- card start -->
                    </div>
                    <!-- col end -->




                    <!-- col start -->
                    <div class="col-md-6">
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
                        '<input type="text" name="arraydata[file'+ x +'][name]" id="name'+ x +'" placeholder="{{ __('admin.applicationdeclined.file_title') }}" value="" class="form-control">' +
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
