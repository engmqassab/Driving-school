@extends('admin.layout.app')

@section('title')
    {{$location_title}}
@stop

@section('css')

    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />


@stop
@section('content')

    <!--begin::Toolbar-->
    <div class="toolbar py-5 py-lg-5" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column me-3">
                <!--begin::Title-->
                <h1 class="d-flex text-dark fw-bolder my-1 fs-3">{{$location_title}}</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-600">
                        <a href="{{ route('admin.home') }}" class="text-gray-600 text-hover-primary">{{__('الصفحه الرئيسية')}}</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-600">{{__('البيانات')}}</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-500">{{$location_title}}</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->

        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->

    <!--begin::Container-->
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->
        <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Card-->
            <div class="card">

                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-5">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed cities-list-table fs-6 gy-5">
                            <!--begin::Table head-->
                            <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th></th>
                                <th>#</th>
                                <th>الاسم</th>
                                <th></th>
                            </tr>
                            <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->

                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Container-->

    <div class="modal fade" tabindex="-1" aria-hidden="true" id="modal_create_new">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">{{__('أضافة مدينة')}}</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Form-->
                    <form id="modal_add_new_form" class="form" action="javascript:void(0)">
                        <!--begin::Scroll-->
                        <input type="hidden" name="id" id="record_id">
                        <!--begin::Alert-->
                        <div class="alert alert-danger bg-light-danger flex-column flex-sm-row p-5 mb-10 " id="error"style="display: none">

                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                <!--begin::Title-->
                                <h4 class="fw-bold">انتبه!</h4>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <span id="error-span"></span>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->

                        </div>
                        <!--end::Alert-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('الاسم')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="الاسم"/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                        </div>
                        <!--end::Scroll-->

                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->

                <div class="modal-footer">
                    <button type="reset" class="btn btn-light me-3" data-modal-create-new-action="cancel" data-bs-dismiss="modal">
                        {{__('الغاء')}}</button>
                    <button type="submit" class="btn btn-primary" id="add_new"  data-modal-create-new-action="submit">
                        <span class="indicator-label">{{__('حفظ')}}</span>
                        <span class="indicator-progress">{{__('يتم الحفظ...')}}
																	<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>

                </div>
            </div>
        </div>
    </div>
    <!--end::Modal - Add task-->


    <!-- begin::Modal - delete record -->
    <div class="modal fade" tabindex="-1" id="delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('حذف ')}}</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <p>{{__('هل انت متاكد من حذف')}} (<span id="name_delete"></span>)</p>
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-light me-3" data-modal-create-new-action="cancel" data-bs-dismiss="modal">
                        {{__('الغاء')}}</button>
                    <button type="submit" class="btn btn-primary" id="delete-record"  data-modal-create-new-action="submit">
                        <span class="indicator-label">{{__('حذف')}}</span>
                        <span class="indicator-progress">{{__('يتم الحذف...')}}
																	<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>

                </div>
            </div>
        </div>
    </div>
    <!-- END: Modal-->

    <!-- begin::Modal - delete record -->
    <div class="modal fade" tabindex="-1" id="modals-delete-all">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('حذف المحدد')}}</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <p>{{__(' هل انت متاكد؟')}}</p>
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-light me-3" data-modal-create-new-action="cancel" data-bs-dismiss="modal">
                        {{__('الغاء')}}</button>
                    <button type="submit" class="btn btn-primary" data-modal-create-new-action="submit" data-bs-toggle="modal"
                            data-bs-target="#modals-delete-all" id="delete">
                        <span class="indicator-label">{{__('حذف')}}</span>
                        <span class="indicator-progress">{{__('يتم الحذف...')}}
																	<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>

                </div>
            </div>
        </div>
    </div>
    <!-- END: Modal-->

    <!-- begin::Modal - delete record -->
    <div class="modal fade" tabindex="-1" id="modals-select">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تحديد</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <p>{{__('الرجاء تحديد عنصر على الأقل!!')}}</p>
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-light me-3" data-modal-create-new-action="cancel" data-bs-dismiss="modal" id="close">
                        {{__('الغاء')}}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Modal-->


@endsection

@section('js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <script>
        var $url = "{{ route('admin.cities.index') }}";
        var $deleteAllurl = "{{ route('admin.cities-destroyAll') }}";

    </script>

    <script src="{{ asset('app-assets/js/emad.js') }}?<?php time() ?>"></script>

    <script>

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#modal_create_new').on('hidden.bs.modal', function () {
                if($('#edit_record').length){
                    document.getElementById("edit_record").id = 'add_new';
                }
                $('#add_new').html("حفظ");
                $('#modal-title').html('أضافة مدينة');
                $('#record_id').val('');
                $('#name').val('');
                $("#error").hide();

            });
            $("#add_new").click(function(e) {

                if($(this).attr('id') == 'add_new'){

                    e.preventDefault();
                    $(this).html("{{ __('يثم الحفظ..')}}");
                    $.ajax({
                        data: $("#modal_add_new_form").serialize(),
                        url: "{{url('admin/cities') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {
                            $('#modal_add_new_form').trigger("reset");
                            $('#modal_create_new').modal('hide');
                            toastr.success('تم الحفظ بنجاح😍😍');
                            $('.cities-list-table').DataTable().ajax.reload();
                            $("#add_new").html("{{ __('حفظ') }}");
                        },
                        error: function(data) {
                            console.log('Error:', data);
                            $("#add_new").html("{{ __('حفظ') }}");
                            toastr.error('يرجى التاكد من ادخال البيانات كاملة');
                            var string = "";
                            $.each(data.responseJSON.errors, function (key, value) {
                                string = string + value[0] + "<br><br>";
                                $("#error-span").html(string);
                            });
                            $("#error").show();

                            e.preventDefault();
                        }
                    })
                }else{
                    var record_id = $('#record_id').val();
                    e.preventDefault();
                    $(this).html("{{ __('يثم التعديل..')}}");
                    $.ajax({
                        data: $("#modal_add_new_form").serialize(),
                        url: "{{url('admin/cities') }}" + '/' + record_id ,
                        type: "POST",
                        method: "PUT",
                        dataType: 'json',
                        success: function(data) {
                            $('#modal_add_new_form').trigger("reset");
                            $('#modal_create_new').modal('hide');
                            toastr.success('تم التعديل بنجاح😍😍');
                            $('.cities-list-table').DataTable().ajax.reload();
                        },
                        error: function(data) {
                            console.log('Error:', data);
                            $("#edit_record").html("{{ __('تعديل') }}");
                            toastr.error('يرجى التاكد من ادخال البيانات كاملة');
                            var string = "";
                            $.each(data.responseJSON.errors, function (key, value) {
                                string = string + value[0] + "<br><br>";
                                $("#error-span").html(string);
                            });
                            $("#error").show();

                            e.preventDefault();
                        }
                    })
                }


            });

            $('body').on('click', '.editRecord', function() {
                var record_id = $(this).data('id');
                $.get("{{ url('admin/cities') }}" + '/' + record_id + '/edit', function(data) {
                    $('#add_new').html("تعديل");
                    $('#modal-title').html('تعديل مدينة');
                    $('#modal_create_new').modal('show');
                    $('#record_id').val(data.id);
                    $('#name').val(data.name);
                    $("#error").hide();
                    document.getElementById("add_new").id = 'edit_record';
                })
            });

            var record_id;
            $(document).on('click', '.deleteRecord', function() {
                record_id = $(this).attr('id');
                $.get("{{ url('admin/cities') }}" + '/' + record_id + '/edit', function(data) {

                    $('#name_delete').html(data.name);
                    $('#delete_modal').modal('show');
                })
            });
            $('#delete-record').click(function() {
                $.ajax({
                    type: "DELETE",
                    url: "{{url('admin/cities') }}" + '/' + record_id,
                    beforeSend: function() {
                        $('#delete-record').html("{{ __('يتم الحذف..') }}");
                    },
                    success: function(data) {
                        $('#delete_modal').modal('hide');
                        $('.cities-list-table').DataTable().ajax.reload();
                        toastr.success('تم الحذف بنجاح😍😍');
                        $('#delete-record').html("{{ __('حذف') }}");
                    }
                })
            });
        });
    </script>
@stop
