$(function () {
    'use strict';

    var dtCarTypeTable = $('.car-types-list-table'),
        dtUserTable = $('.user-list-table'),
        dtCarLicenseTable = $('.car-license-list-table'),
        dtCarInsuranceTable = $('.car-insurances-list-table'),
        dtCheckTypeTable = $('.check-types-list-table'),
        dtCheckCasesTable = $('.check-cases-list-table'),
        dtCheckResultsTable = $('.check-results-list-table'),
        dtCarsTable = $('.cars-list-table'),
        dtDriveLicenseTable = $('.drive-licenses-list-table'),
        dtCitiesTable = $('.cities-list-table'),
        dtStudentsTable = $('.students-list-table'),
        dtTrainersTable = $('.trainers-list-table'),
        dtApplicatoinCasesTable = $('.application-cases-list-table'),
        dtApplicatoinsTable = $('.applications-list-table'),
        dtTransferTypesTable = $('.transfer-types-list-table');


    if (dtUserTable.length) {
        dtUserTable.DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url: $url
            }, // JSON file to add data
            columns: [
                // columns according to JSON
                {data: 'id'},
                {data: 'DT_RowIndex'},
                {data: 'name'},
                {data: 'username'},
                {data: 'email'},
                {data: 'actions', orderable: false},
            ],
            columnDefs: [{
                targets: 5,
                width: '400px',

            },
                // For Checkboxes
                {
                    targets: 0,
                    orderable: false,
                    responsivePriority: 3,
                    render: function (data, type, full, meta) {
                        var auth_id = full['auth_id'];
                        var id = full['id'];

                        if (auth_id !== data) {
                            return (
                                '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input dt-checkboxes" type="checkbox" value=' +
                                data +
                                ' id="checkbox' +
                                data +
                                '" /><label class="custom-control-label" for="checkbox' +
                                data +
                                '"></label></div>'
                            );
                        } else {
                            return (
                                '<div class="custom-control custom-checkbox"></div>'
                            );
                        }
                    },
                    checkboxes: {
                        selectAllRender: '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                    }
                },
            ],
            order: [0, 'asc'],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'عرض _MENU_',
                zeroRecords: 'لا يوجد بيانات',
                info: "عرض الصفحات _PAGE_ من _PAGES_",
                infoEmpty: 'عرض 0 صفحات',
                search: '',
                searchPlaceholder: 'بحث..',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '<i class="las la-angle-double-right"></i>',
                    next: '<i class="las la-angle-double-left"></i>'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: '<span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" /> <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" /></svg></span>',
                className: 'add-new btn btn-light-primary fw-bolder btn-icon mt-50 white',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#modal_create_new',
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }

            },
                {
                    text: '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                        '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                        '        <rect x="0" y="0" width="24" height="24"/>\n' +
                        '        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>\n' +
                        '        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\n' +
                        '    </g>\n' +
                        '</svg><!--end::Svg Icon--></span>',
                    className: 'add-new btn btn-light-danger btn-icon mt-50 btnToggleusers',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#modals-select',
                        'id': 'delete-all'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }

                },
            ],

        });
    }
    $(document).on('click', '.btnToggleusers', function () {
        var id = [];

        $('#modals-delete-all').on('hide.bs.modal show.bs.modal', function (event) {
            var $activeElement = $(document.activeElement);

            if ($activeElement.is('[data-bs-toggle], [data-dismiss]')) {
                if ($activeElement[0].id == 'delete') {
                    $('.dt-checkboxes:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: $deleteAllurl,
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                toastr.success('تم الحذف بنجاح😍😍');
                                var deleteButton = document.getElementById('delete-all');
                                deleteButton.setAttribute("data-bs-target", "#modals-select");
                                dtUserTable.DataTable().ajax.reload();
                            }
                        });
                    } else {
                        $('#modals-select').modal('toggle');
                    }
                }
            }
        });

    });
    if (dtCarTypeTable.length) {
        dtCarTypeTable.DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url: $url
            }, // JSON file to add data
            columns: [
                // columns according to JSON
                {data: 'id'},
                {data: 'DT_RowIndex'},
                {data: 'name'},
                {data: 'model'},
                {data: 'year'},
                {data: 'description'},
                {data: 'actions', orderable: false},
            ],
            columnDefs: [{
                targets: 6,
                width: '400px',

            }, {
                // For Checkboxes
                targets: 0,
                orderable: false,
                responsivePriority: 3,
                render: function (data, type, full, meta) {
                    return (
                        '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input dt-checkboxes" type="checkbox" value=' +
                        data +
                        ' id="checkbox' +
                        data +
                        '" /><label class="custom-control-label" for="checkbox' +
                        data +
                        '"></label></div>'
                    );
                },
                checkboxes: {
                    selectAllRender: '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                }
            },],
            order: [1, 'asc'],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'عرض _MENU_',
                zeroRecords: 'لا يوجد بيانات',
                info: "عرض الصفحات _PAGE_ من _PAGES_",
                infoEmpty: 'عرض 0 صفحات',
                search: '',
                searchPlaceholder: 'بحث..',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '<i class="las la-angle-double-right"></i>',
                    next: '<i class="las la-angle-double-left"></i>'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: '<span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" /> <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" /></svg></span>',
                className: 'add-new btn btn-light-primary fw-bolder btn-icon mt-50 white',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#modal_create_new',
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }

            },
                {
                    text: '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                        '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                        '        <rect x="0" y="0" width="24" height="24"/>\n' +
                        '        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>\n' +
                        '        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\n' +
                        '    </g>\n' +
                        '</svg><!--end::Svg Icon--></span>',
                    className: 'add-new btn btn-light-danger btn-icon mt-50 btnToggleCarTypes',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#modals-select',
                        'id': 'delete-all'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }

                },
            ],

        });
    }

    $(document).on('click', '.btnToggleCarTypes', function () {
        var id = [];
        $('#modals-delete-all').on('hide.bs.modal show.bs.modal', function (event) {
            var $activeElement = $(document.activeElement);

            if ($activeElement.is('[data-bs-toggle], [data-dismiss]')) {
                if ($activeElement[0].id == 'delete') {
                    $('.dt-checkboxes:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: $deleteAllurl,
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                toastr.success('تم الحذف بنجاح😍😍');
                                var deleteButton = document.getElementById('delete-all');
                                deleteButton.setAttribute("data-bs-target", "#modals-select");
                                dtCarTypeTable.DataTable().ajax.reload();
                            }
                        });
                    } else {
                        $('#modals-select').modal('toggle');
                    }
                }
            }
        });

    });

    if (dtCarLicenseTable.length) {
        dtCarLicenseTable.DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url: $url
            }, // JSON file to add data
            columns: [
                // columns according to JSON
                {data: 'id'},
                {data: 'DT_RowIndex'},
                {data: 'name'},
                {data: 'description'},
                {data: 'actions', orderable: false},
            ],
            columnDefs: [{
                targets: 4,
                width: '400px',

            }, {
                // For Checkboxes
                targets: 0,
                orderable: false,
                responsivePriority: 3,
                render: function (data, type, full, meta) {
                    return (
                        '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input dt-checkboxes" type="checkbox" value=' +
                        data +
                        ' id="checkbox' +
                        data +
                        '" /><label class="custom-control-label" for="checkbox' +
                        data +
                        '"></label></div>'
                    );
                },
                checkboxes: {
                    selectAllRender: '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                }
            },],
            order: [1, 'asc'],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'عرض _MENU_',
                zeroRecords: 'لا يوجد بيانات',
                info: "عرض الصفحات _PAGE_ من _PAGES_",
                infoEmpty: 'عرض 0 صفحات',
                search: '',
                searchPlaceholder: 'بحث..',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '<i class="las la-angle-double-right"></i>',
                    next: '<i class="las la-angle-double-left"></i>'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: '<span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" /> <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" /></svg></span>',
                className: 'add-new btn btn-light-primary fw-bolder btn-icon mt-50 white',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#modal_create_new',
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }

            },
                {
                    text: '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                        '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                        '        <rect x="0" y="0" width="24" height="24"/>\n' +
                        '        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>\n' +
                        '        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\n' +
                        '    </g>\n' +
                        '</svg><!--end::Svg Icon--></span>',
                    className: 'add-new btn btn-light-danger btn-icon mt-50 btnToggleCarLicenses',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#modals-select',
                        'id': 'delete-all'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }

                },
            ],

        });
    }

    $(document).on('click', '.btnToggleCarLicenses', function () {
        var id = [];
        $('#modals-delete-all').on('hide.bs.modal show.bs.modal', function (event) {
            var $activeElement = $(document.activeElement);

            if ($activeElement.is('[data-bs-toggle], [data-dismiss]')) {
                if ($activeElement[0].id == 'delete') {
                    $('.dt-checkboxes:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: $deleteAllurl,
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                toastr.success('تم الحذف بنجاح😍😍');
                                var deleteButton = document.getElementById('delete-all');
                                deleteButton.setAttribute("data-bs-target", "#modals-select");
                                dtCarLicenseTable.DataTable().ajax.reload();
                            }
                        });
                    } else {
                        $('#modals-select').modal('toggle');
                    }
                }
            }
        });

    });

    if (dtCarInsuranceTable.length) {
        dtCarInsuranceTable.DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url: $url
            }, // JSON file to add data
            columns: [
                // columns according to JSON
                {data: 'id'},
                {data: 'DT_RowIndex'},
                {data: 'name'},
                {data: 'description'},
                {data: 'actions', orderable: false},
            ],
            columnDefs: [{
                targets: 4,
                width: '400px',

            }, {
                // For Checkboxes
                targets: 0,
                orderable: false,
                responsivePriority: 3,
                render: function (data, type, full, meta) {
                    return (
                        '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input dt-checkboxes" type="checkbox" value=' +
                        data +
                        ' id="checkbox' +
                        data +
                        '" /><label class="custom-control-label" for="checkbox' +
                        data +
                        '"></label></div>'
                    );
                },
                checkboxes: {
                    selectAllRender: '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                }
            },],
            order: [1, 'asc'],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'عرض _MENU_',
                zeroRecords: 'لا يوجد بيانات',
                info: "عرض الصفحات _PAGE_ من _PAGES_",
                infoEmpty: 'عرض 0 صفحات',
                search: '',
                searchPlaceholder: 'بحث..',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '<i class="las la-angle-double-right"></i>',
                    next: '<i class="las la-angle-double-left"></i>'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: '<span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" /> <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" /></svg></span>',
                className: 'add-new btn btn-light-primary fw-bolder btn-icon mt-50 white',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#modal_create_new',
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }

            },
                {
                    text: '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                        '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                        '        <rect x="0" y="0" width="24" height="24"/>\n' +
                        '        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>\n' +
                        '        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\n' +
                        '    </g>\n' +
                        '</svg><!--end::Svg Icon--></span>',
                    className: 'add-new btn btn-light-danger btn-icon mt-50 btnToggleCarInsurances',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#modals-select',
                        'id': 'delete-all'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }

                },
            ],

        });
    }

    $(document).on('click', '.btnToggleCarInsurances', function () {
        var id = [];
        $('#modals-delete-all').on('hide.bs.modal show.bs.modal', function (event) {
            var $activeElement = $(document.activeElement);

            if ($activeElement.is('[data-bs-toggle], [data-dismiss]')) {
                if ($activeElement[0].id == 'delete') {
                    $('.dt-checkboxes:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: $deleteAllurl,
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                toastr.success('تم الحذف بنجاح😍😍');
                                var deleteButton = document.getElementById('delete-all');
                                deleteButton.setAttribute("data-bs-target", "#modals-select");
                                dtCarInsuranceTable.DataTable().ajax.reload();
                            }
                        });
                    } else {
                        $('#modals-select').modal('toggle');
                    }
                }
            }
        });

    });

    if (dtCheckTypeTable.length) {
        dtCheckTypeTable.DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url: $url
            }, // JSON file to add data
            columns: [
                // columns according to JSON
                {data: 'id'},
                {data: 'DT_RowIndex'},
                {data: 'name'},
                {data: 'description'},
                {data: 'actions', orderable: false},
            ],
            columnDefs: [{
                targets: 4,
                width: '400px',

            }, {
                // For Checkboxes
                targets: 0,
                orderable: false,
                responsivePriority: 3,
                render: function (data, type, full, meta) {
                    return (
                        '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input dt-checkboxes" type="checkbox" value=' +
                        data +
                        ' id="checkbox' +
                        data +
                        '" /><label class="custom-control-label" for="checkbox' +
                        data +
                        '"></label></div>'
                    );
                },
                checkboxes: {
                    selectAllRender: '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                }
            },],
            order: [1, 'asc'],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'عرض _MENU_',
                zeroRecords: 'لا يوجد بيانات',
                info: "عرض الصفحات _PAGE_ من _PAGES_",
                infoEmpty: 'عرض 0 صفحات',
                search: '',
                searchPlaceholder: 'بحث..',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '<i class="las la-angle-double-right"></i>',
                    next: '<i class="las la-angle-double-left"></i>'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: '<span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" /> <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" /></svg></span>',
                className: 'add-new btn btn-light-primary fw-bolder btn-icon mt-50 white',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#modal_create_new',
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }

            },
                {
                    text: '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                        '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                        '        <rect x="0" y="0" width="24" height="24"/>\n' +
                        '        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>\n' +
                        '        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\n' +
                        '    </g>\n' +
                        '</svg><!--end::Svg Icon--></span>',
                    className: 'add-new btn btn-light-danger btn-icon mt-50 btnToggleCheckType',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#modals-select',
                        'id': 'delete-all'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }

                },
            ],

        });
    }

    $(document).on('click', '.btnToggleCheckType', function () {
        var id = [];
        $('#modals-delete-all').on('hide.bs.modal show.bs.modal', function (event) {
            var $activeElement = $(document.activeElement);

            if ($activeElement.is('[data-bs-toggle], [data-dismiss]')) {
                if ($activeElement[0].id == 'delete') {
                    $('.dt-checkboxes:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: $deleteAllurl,
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                toastr.success('تم الحذف بنجاح😍😍');
                                var deleteButton = document.getElementById('delete-all');
                                deleteButton.setAttribute("data-bs-target", "#modals-select");
                                dtCheckTypeTable.DataTable().ajax.reload();
                            }
                        });
                    } else {
                        $('#modals-select').modal('toggle');
                    }
                }
            }
        });

    });

    if (dtCheckCasesTable.length) {
        dtCheckCasesTable.DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url: $url
            }, // JSON file to add data
            columns: [
                // columns according to JSON
                {data: 'id'},
                {data: 'DT_RowIndex'},
                {data: 'name'},
                {data: 'description'},
                {data: 'actions', orderable: false},
            ],
            columnDefs: [{
                targets: 4,
                width: '400px',

            }, {
                // For Checkboxes
                targets: 0,
                orderable: false,
                responsivePriority: 3,
                render: function (data, type, full, meta) {
                    return (
                        '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input dt-checkboxes" type="checkbox" value=' +
                        data +
                        ' id="checkbox' +
                        data +
                        '" /><label class="custom-control-label" for="checkbox' +
                        data +
                        '"></label></div>'
                    );
                },
                checkboxes: {
                    selectAllRender: '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                }
            },],
            order: [1, 'asc'],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'عرض _MENU_',
                zeroRecords: 'لا يوجد بيانات',
                info: "عرض الصفحات _PAGE_ من _PAGES_",
                infoEmpty: 'عرض 0 صفحات',
                search: '',
                searchPlaceholder: 'بحث..',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '<i class="las la-angle-double-right"></i>',
                    next: '<i class="las la-angle-double-left"></i>'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: '<span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" /> <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" /></svg></span>',
                className: 'add-new btn btn-light-primary fw-bolder btn-icon mt-50 white',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#modal_create_new',
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }

            },
                {
                    text: '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                        '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                        '        <rect x="0" y="0" width="24" height="24"/>\n' +
                        '        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>\n' +
                        '        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\n' +
                        '    </g>\n' +
                        '</svg><!--end::Svg Icon--></span>',
                    className: 'add-new btn btn-light-danger btn-icon mt-50 btnToggleCheckCases',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#modals-select',
                        'id': 'delete-all'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }

                },
            ],

        });
    }

    $(document).on('click', '.btnToggleCheckCases', function () {
        var id = [];
        $('#modals-delete-all').on('hide.bs.modal show.bs.modal', function (event) {
            var $activeElement = $(document.activeElement);

            if ($activeElement.is('[data-bs-toggle], [data-dismiss]')) {
                if ($activeElement[0].id == 'delete') {
                    $('.dt-checkboxes:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: $deleteAllurl,
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                toastr.success('تم الحذف بنجاح😍😍');
                                var deleteButton = document.getElementById('delete-all');
                                deleteButton.setAttribute("data-bs-target", "#modals-select");
                                dtCheckCasesTable.DataTable().ajax.reload();
                            }
                        });
                    } else {
                        $('#modals-select').modal('toggle');
                    }
                }
            }
        });

    });

    if (dtCheckResultsTable.length) {
        dtCheckResultsTable.DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url: $url
            }, // JSON file to add data
            columns: [
                // columns according to JSON
                {data: 'id'},
                {data: 'DT_RowIndex'},
                {data: 'name'},
                {data: 'description'},
                {data: 'actions', orderable: false},
            ],
            columnDefs: [{
                targets: 4,
                width: '400px',

            }, {
                // For Checkboxes
                targets: 0,
                orderable: false,
                responsivePriority: 3,
                render: function (data, type, full, meta) {
                    return (
                        '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input dt-checkboxes" type="checkbox" value=' +
                        data +
                        ' id="checkbox' +
                        data +
                        '" /><label class="custom-control-label" for="checkbox' +
                        data +
                        '"></label></div>'
                    );
                },
                checkboxes: {
                    selectAllRender: '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                }
            },],
            order: [1, 'asc'],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'عرض _MENU_',
                zeroRecords: 'لا يوجد بيانات',
                info: "عرض الصفحات _PAGE_ من _PAGES_",
                infoEmpty: 'عرض 0 صفحات',
                search: '',
                searchPlaceholder: 'بحث..',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '<i class="las la-angle-double-right"></i>',
                    next: '<i class="las la-angle-double-left"></i>'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: '<span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" /> <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" /></svg></span>',
                className: 'add-new btn btn-light-primary fw-bolder btn-icon mt-50 white',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#modal_create_new',
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }

            },
                {
                    text: '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                        '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                        '        <rect x="0" y="0" width="24" height="24"/>\n' +
                        '        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>\n' +
                        '        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\n' +
                        '    </g>\n' +
                        '</svg><!--end::Svg Icon--></span>',
                    className: 'add-new btn btn-light-danger btn-icon mt-50 btnToggleCheckResults',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#modals-select',
                        'id': 'delete-all'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }

                },
            ],

        });
    }

    $(document).on('click', '.btnToggleCheckResults', function () {
        var id = [];
        $('#modals-delete-all').on('hide.bs.modal show.bs.modal', function (event) {
            var $activeElement = $(document.activeElement);

            if ($activeElement.is('[data-bs-toggle], [data-dismiss]')) {
                if ($activeElement[0].id == 'delete') {
                    $('.dt-checkboxes:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: $deleteAllurl,
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                toastr.success('تم الحذف بنجاح😍😍');
                                var deleteButton = document.getElementById('delete-all');
                                deleteButton.setAttribute("data-bs-target", "#modals-select");
                                dtCheckResultsTable.DataTable().ajax.reload();
                            }
                        });
                    } else {
                        $('#modals-select').modal('toggle');
                    }
                }
            }
        });

    });

    if (dtCarsTable.length) {
        dtCarsTable.DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url: $url
            }, // JSON file to add data
            columns: [
                // columns according to JSON
                {data: 'id'},
                {data: 'DT_RowIndex'},
                {data: 'car_number'},
                {data: 'type'},
                {data: 'license'},
                {data: 'insurance'},
                {data: 'year'},
                {data: 'description'},
                {data: 'actions', orderable: false},
            ],
            columnDefs: [{
                targets: 8,
                width: '400px',

            }, {
                // For Checkboxes
                targets: 0,
                orderable: false,
                responsivePriority: 3,
                render: function (data, type, full, meta) {
                    return (
                        '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input dt-checkboxes" type="checkbox" value=' +
                        data +
                        ' id="checkbox' +
                        data +
                        '" /><label class="custom-control-label" for="checkbox' +
                        data +
                        '"></label></div>'
                    );
                },
                checkboxes: {
                    selectAllRender: '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                }
            },],
            order: [1, 'asc'],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'عرض _MENU_',
                zeroRecords: 'لا يوجد بيانات',
                info: "عرض الصفحات _PAGE_ من _PAGES_",
                infoEmpty: 'عرض 0 صفحات',
                search: '',
                searchPlaceholder: 'بحث..',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '<i class="las la-angle-double-right"></i>',
                    next: '<i class="las la-angle-double-left"></i>'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: '<span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" /> <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" /></svg></span>',
                className: 'add-new btn btn-light-primary fw-bolder btn-icon mt-50 white',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#modal_create_new',
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }

            },
                {
                    text: '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                        '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                        '        <rect x="0" y="0" width="24" height="24"/>\n' +
                        '        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>\n' +
                        '        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\n' +
                        '    </g>\n' +
                        '</svg><!--end::Svg Icon--></span>',
                    className: 'add-new btn btn-light-danger btn-icon mt-50 btnToggleCars',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#modals-select',
                        'id': 'delete-all'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }

                },
            ],

        });
    }

    $(document).on('change', 'input[type="checkbox"]', function () {

        if ($('input[type="checkbox"]').prop("checked") == true) {
            var deleteButton = document.getElementById('delete-all');
            deleteButton.setAttribute("data-bs-target", "#modals-delete-all");
        } else {
            var deleteButton = document.getElementById('delete-all');
            deleteButton.setAttribute("data-bs-target", "#modals-select");

        }
    });

    $(document).on('click', '.btnToggleCars', function () {
        var id = [];

        $('#modals-delete-all').on('hide.bs.modal show.bs.modal', function (event) {
            var $activeElement = $(document.activeElement);

            if ($activeElement.is('[data-bs-toggle], [data-dismiss]')) {
                if ($activeElement[0].id == 'delete') {
                    $('.dt-checkboxes:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: $deleteAllurl,
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                toastr.success('تم الحذف بنجاح😍😍');
                                var deleteButton = document.getElementById('delete-all');
                                deleteButton.setAttribute("data-bs-target", "#modals-select");
                                dtCarsTable.DataTable().ajax.reload();
                            }
                        });
                    } else {
                        $('#modals-select').modal('toggle');
                    }
                }
            }
        });

    });

    if (dtDriveLicenseTable.length) {
        dtDriveLicenseTable.DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url: $url
            }, // JSON file to add data
            columns: [
                // columns according to JSON
                {data: 'id'},
                {data: 'DT_RowIndex'},
                {data: 'name'},
                {data: 'description'},
                {data: 'actions', orderable: false},
            ],
            columnDefs: [{
                targets: 4,
                width: '400px',

            }, {
                // For Checkboxes
                targets: 0,
                orderable: false,
                responsivePriority: 3,
                render: function (data, type, full, meta) {
                    return (
                        '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input dt-checkboxes" type="checkbox" value=' +
                        data +
                        ' id="checkbox' +
                        data +
                        '" /><label class="custom-control-label" for="checkbox' +
                        data +
                        '"></label></div>'
                    );
                },
                checkboxes: {
                    selectAllRender: '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                }
            },],
            order: [1, 'asc'],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'عرض _MENU_',
                zeroRecords: 'لا يوجد بيانات',
                info: "عرض الصفحات _PAGE_ من _PAGES_",
                infoEmpty: 'عرض 0 صفحات',
                search: '',
                searchPlaceholder: 'بحث..',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '<i class="las la-angle-double-right"></i>',
                    next: '<i class="las la-angle-double-left"></i>'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: '<span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" /> <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" /></svg></span>',
                className: 'add-new btn btn-light-primary fw-bolder btn-icon mt-50 white',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#modal_create_new',
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }

            },
                {
                    text: '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                        '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                        '        <rect x="0" y="0" width="24" height="24"/>\n' +
                        '        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>\n' +
                        '        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\n' +
                        '    </g>\n' +
                        '</svg><!--end::Svg Icon--></span>',
                    className: 'add-new btn btn-light-danger btn-icon mt-50 btnToggleDriveLicenses',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#modals-select',
                        'id': 'delete-all'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }

                },
            ],

        });
    }

    $(document).on('click', '.btnToggleDriveLicenses', function () {
        var id = [];
        $('#modals-delete-all').on('hide.bs.modal show.bs.modal', function (event) {
            var $activeElement = $(document.activeElement);

            if ($activeElement.is('[data-bs-toggle], [data-dismiss]')) {
                if ($activeElement[0].id == 'delete') {
                    $('.dt-checkboxes:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: $deleteAllurl,
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                toastr.success('تم الحذف بنجاح😍😍');
                                var deleteButton = document.getElementById('delete-all');
                                deleteButton.setAttribute("data-bs-target", "#modals-select");
                                dtDriveLicenseTable.DataTable().ajax.reload();
                            }
                        });
                    } else {
                        $('#modals-select').modal('toggle');
                    }
                }
            }
        });

    });

    if (dtCitiesTable.length) {
        dtCitiesTable.DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url: $url
            }, // JSON file to add data
            columns: [
                // columns according to JSON
                {data: 'id'},
                {data: 'DT_RowIndex'},
                {data: 'name'},
                {data: 'actions', orderable: false},
            ],
            columnDefs: [{
                targets: 3,
                width: '400px',

            }, {
                // For Checkboxes
                targets: 0,
                orderable: false,
                responsivePriority: 3,
                render: function (data, type, full, meta) {
                    return (
                        '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input dt-checkboxes" type="checkbox" value=' +
                        data +
                        ' id="checkbox' +
                        data +
                        '" /><label class="custom-control-label" for="checkbox' +
                        data +
                        '"></label></div>'
                    );
                },
                checkboxes: {
                    selectAllRender: '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                }
            },],
            order: [1, 'asc'],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'عرض _MENU_',
                zeroRecords: 'لا يوجد بيانات',
                info: "عرض الصفحات _PAGE_ من _PAGES_",
                infoEmpty: 'عرض 0 صفحات',
                search: '',
                searchPlaceholder: 'بحث..',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '<i class="las la-angle-double-right"></i>',
                    next: '<i class="las la-angle-double-left"></i>'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: '<span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" /> <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" /></svg></span>',
                className: 'add-new btn btn-light-primary fw-bolder btn-icon mt-50 white',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#modal_create_new',
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }

            },
                {
                    text: '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                        '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                        '        <rect x="0" y="0" width="24" height="24"/>\n' +
                        '        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>\n' +
                        '        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\n' +
                        '    </g>\n' +
                        '</svg><!--end::Svg Icon--></span>',
                    className: 'add-new btn btn-light-danger btn-icon mt-50 btnToggleCities',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#modals-select',
                        'id': 'delete-all'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }

                },
            ],

        });
    }

    $(document).on('click', '.btnToggleCities', function () {
        var id = [];
        $('#modals-delete-all').on('hide.bs.modal show.bs.modal', function (event) {
            var $activeElement = $(document.activeElement);

            if ($activeElement.is('[data-bs-toggle], [data-dismiss]')) {
                if ($activeElement[0].id == 'delete') {
                    $('.dt-checkboxes:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: $deleteAllurl,
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                toastr.success('تم الحذف بنجاح😍😍');
                                var deleteButton = document.getElementById('delete-all');
                                deleteButton.setAttribute("data-bs-target", "#modals-select");
                                dtCitiesTable.DataTable().ajax.reload();
                            }
                        });
                    } else {
                        $('#modals-select').modal('toggle');
                    }
                }
            }
        });

    });

    if (dtStudentsTable.length) {
        dtStudentsTable.DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url: $url
            }, // JSON file to add data
            columns: [
                // columns according to JSON
                {data: 'id'},
                {data: 'DT_RowIndex'},
                {data: 'card_id'},
                {data: 'name'},
                {data: 'mobile'},
                {data: 'city'},
                {data: 'birth_date'},
                {data: 'actions', orderable: false},
            ],
            columnDefs: [{
                targets: 7,
                width: '400px',

            }, {
                // For Checkboxes
                targets: 0,
                orderable: false,
                responsivePriority: 3,
                render: function (data, type, full, meta) {
                    return (
                        '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input dt-checkboxes" type="checkbox" value=' +
                        data +
                        ' id="checkbox' +
                        data +
                        '" /><label class="custom-control-label" for="checkbox' +
                        data +
                        '"></label></div>'
                    );
                },
                checkboxes: {
                    selectAllRender: '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                }
            },],
            order: [1, 'asc'],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'عرض _MENU_',
                zeroRecords: 'لا يوجد بيانات',
                info: "عرض الصفحات _PAGE_ من _PAGES_",
                infoEmpty: 'عرض 0 صفحات',
                search: '',
                searchPlaceholder: 'بحث..',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '<i class="las la-angle-double-right"></i>',
                    next: '<i class="las la-angle-double-left"></i>'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: '<span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" /> <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" /></svg></span>',
                className: 'add-new btn btn-light-primary fw-bolder btn-icon mt-50 white',
                attr: {
                    'onclick': 'document.location.href="' + $createurl + '"',
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }

            },
                {
                    text: '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                        '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                        '        <rect x="0" y="0" width="24" height="24"/>\n' +
                        '        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>\n' +
                        '        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\n' +
                        '    </g>\n' +
                        '</svg><!--end::Svg Icon--></span>',
                    className: 'add-new btn btn-light-danger btn-icon mt-50 btnToggleStudants',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#modals-select',
                        'id': 'delete-all'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }

                },
            ],

        });
    }

    $(document).on('click', '.btnToggleStudants', function () {
        var id = [];
        $('#modals-delete-all').on('hide.bs.modal show.bs.modal', function (event) {
            var $activeElement = $(document.activeElement);

            if ($activeElement.is('[data-bs-toggle], [data-dismiss]')) {
                if ($activeElement[0].id == 'delete') {
                    $('.dt-checkboxes:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: $deleteAllurl,
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                toastr.success('تم الحذف بنجاح😍😍');
                                var deleteButton = document.getElementById('delete-all');
                                deleteButton.setAttribute("data-bs-target", "#modals-select");
                                dtStudentsTable.DataTable().ajax.reload();
                            }
                        });
                    } else {
                        $('#modals-select').modal('toggle');
                    }
                }
            }
        });

    });

    if (dtTrainersTable.length) {
        dtTrainersTable.DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url: $url
            }, // JSON file to add data
            columns: [
                // columns according to JSON
                {data: 'id'},
                {data: 'DT_RowIndex'},
                {data: 'card_id'},
                {data: 'name'},
                {data: 'mobile'},
                {data: 'phone'},
                {data: 'address'},
                {data: 'actions', orderable: false},
            ],
            columnDefs: [{
                targets: 7,
                width: '400px',

            }, {
                // For Checkboxes
                targets: 0,
                orderable: false,
                responsivePriority: 3,
                render: function (data, type, full, meta) {
                    return (
                        '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input dt-checkboxes" type="checkbox" value=' +
                        data +
                        ' id="checkbox' +
                        data +
                        '" /><label class="custom-control-label" for="checkbox' +
                        data +
                        '"></label></div>'
                    );
                },
                checkboxes: {
                    selectAllRender: '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                }
            },],
            order: [1, 'asc'],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'عرض _MENU_',
                zeroRecords: 'لا يوجد بيانات',
                info: "عرض الصفحات _PAGE_ من _PAGES_",
                infoEmpty: 'عرض 0 صفحات',
                search: '',
                searchPlaceholder: 'بحث..',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '<i class="las la-angle-double-right"></i>',
                    next: '<i class="las la-angle-double-left"></i>'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: '<span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" /> <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" /></svg></span>',
                className: 'add-new btn btn-light-primary fw-bolder btn-icon mt-50 white',
                attr: {
                    'onclick': 'document.location.href="' + $createurl + '"',
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }

            },
                {
                    text: '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                        '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                        '        <rect x="0" y="0" width="24" height="24"/>\n' +
                        '        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>\n' +
                        '        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\n' +
                        '    </g>\n' +
                        '</svg><!--end::Svg Icon--></span>',
                    className: 'add-new btn btn-light-danger btn-icon mt-50 btnToggleTrainers',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#modals-select',
                        'id': 'delete-all'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }

                },
            ],

        });
    }

    $(document).on('click', '.btnToggleTrainers', function () {
        var id = [];
        $('#modals-delete-all').on('hide.bs.modal show.bs.modal', function (event) {
            var $activeElement = $(document.activeElement);

            if ($activeElement.is('[data-bs-toggle], [data-dismiss]')) {
                if ($activeElement[0].id == 'delete') {
                    $('.dt-checkboxes:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: $deleteAllurl,
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                toastr.success('تم الحذف بنجاح😍😍');
                                var deleteButton = document.getElementById('delete-all');
                                deleteButton.setAttribute("data-bs-target", "#modals-select");
                                dtTrainersTable.DataTable().ajax.reload();
                            }
                        });
                    } else {
                        $('#modals-select').modal('toggle');
                    }
                }
            }
        });

    });

    if (dtApplicatoinCasesTable.length) {
        dtApplicatoinCasesTable.DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url: $url
            }, // JSON file to add data
            columns: [
                // columns according to JSON
                {data: 'id'},
                {data: 'DT_RowIndex'},
                {data: 'name'},
                {data: 'description'},
                {data: 'actions', orderable: false},
            ],
            columnDefs: [{
                targets: 4,
                width: '400px',

            }, {
                // For Checkboxes
                targets: 0,
                orderable: false,
                responsivePriority: 3,
                render: function (data, type, full, meta) {
                    return (
                        '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input dt-checkboxes" type="checkbox" value=' +
                        data +
                        ' id="checkbox' +
                        data +
                        '" /><label class="custom-control-label" for="checkbox' +
                        data +
                        '"></label></div>'
                    );
                },
                checkboxes: {
                    selectAllRender: '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                }
            },],
            order: [1, 'asc'],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'عرض _MENU_',
                zeroRecords: 'لا يوجد بيانات',
                info: "عرض الصفحات _PAGE_ من _PAGES_",
                infoEmpty: 'عرض 0 صفحات',
                search: '',
                searchPlaceholder: 'بحث..',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '<i class="las la-angle-double-right"></i>',
                    next: '<i class="las la-angle-double-left"></i>'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: '<span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" /> <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" /></svg></span>',
                className: 'add-new btn btn-light-primary fw-bolder btn-icon mt-50 white',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#modal_create_new',
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }

            },
                {
                    text: '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                        '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                        '        <rect x="0" y="0" width="24" height="24"/>\n' +
                        '        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>\n' +
                        '        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\n' +
                        '    </g>\n' +
                        '</svg><!--end::Svg Icon--></span>',
                    className: 'add-new btn btn-light-danger btn-icon mt-50 btnToggleApplicatoinCases',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#modals-select',
                        'id': 'delete-all'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }

                },
            ],

        });
    }

    $(document).on('click', '.btnToggleApplicatoinCases', function () {
        var id = [];
        $('#modals-delete-all').on('hide.bs.modal show.bs.modal', function (event) {
            var $activeElement = $(document.activeElement);

            if ($activeElement.is('[data-bs-toggle], [data-dismiss]')) {
                if ($activeElement[0].id == 'delete') {
                    $('.dt-checkboxes:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: $deleteAllurl,
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                toastr.success('تم الحذف بنجاح😍😍');
                                var deleteButton = document.getElementById('delete-all');
                                deleteButton.setAttribute("data-bs-target", "#modals-select");
                                dtApplicatoinCasesTable.DataTable().ajax.reload();
                            }
                        });
                    } else {
                        $('#modals-select').modal('toggle');
                    }
                }
            }
        });

    });

    if (dtApplicatoinsTable.length) {
        dtApplicatoinsTable.DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url: $url
            }, // JSON file to add data
            columns: [
                // columns according to JSON
                {data: 'id'},
                {data: 'DT_RowIndex'},
                {data: 'name'},
                {data: 'case'},
                {data: 'arr_type'},
                {data: 'application_date'},
                {data: 'actions', orderable: false},
            ],
            columnDefs: [{
                targets: 6,
                width: '400px',

            }, {
                // For Checkboxes
                targets: 0,
                orderable: false,
                responsivePriority: 3,
                render: function (data, type, full, meta) {
                    return (
                        '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input dt-checkboxes" type="checkbox" value=' +
                        data +
                        ' id="checkbox' +
                        data +
                        '" /><label class="custom-control-label" for="checkbox' +
                        data +
                        '"></label></div>'
                    );
                },
                checkboxes: {
                    selectAllRender: '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                }
            },],
            order: [1, 'asc'],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'عرض _MENU_',
                zeroRecords: 'لا يوجد بيانات',
                info: 'عرض الصفحات _PAGE_ من _PAGES_',
                search: '',
                infoEmpty: 'عرض 0 صفحات',
                searchPlaceholder: 'بحث..',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '<i class="las la-angle-double-right"></i>',
                    next: '<i class="las la-angle-double-left"></i>'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: '<span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" /> <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" /></svg></span>',
                className: 'add-new btn btn-light-primary fw-bolder btn-icon mt-50 white',
                attr: {
                    'onclick': 'document.location.href="' + $createurl + '"',
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }

            },
                {
                    text: '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                        '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                        '        <rect x="0" y="0" width="24" height="24"/>\n' +
                        '        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>\n' +
                        '        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\n' +
                        '    </g>\n' +
                        '</svg><!--end::Svg Icon--></span>',
                    className: 'add-new btn btn-light-danger btn-icon mt-50 btnToggleApplications',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#modals-select',
                        'id': 'delete-all'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }

                },
            ],

        });
    }

    $(document).on('click', '.btnToggleApplications', function () {
        var id = [];
        $('#modals-delete-all').on('hide.bs.modal show.bs.modal', function (event) {
            var $activeElement = $(document.activeElement);

            if ($activeElement.is('[data-bs-toggle], [data-dismiss]')) {
                if ($activeElement[0].id == 'delete') {
                    $('.dt-checkboxes:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: $deleteAllurl,
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                toastr.success('تم الحذف بنجاح😍😍');
                                var deleteButton = document.getElementById('delete-all');
                                deleteButton.setAttribute("data-bs-target", "#modals-select");
                                dtApplicatoinsTable.DataTable().ajax.reload();
                            }
                        });
                    } else {
                        $('#modals-select').modal('toggle');
                    }
                }
            }
        });

    });


    if (dtTransferTypesTable.length) {
        dtTransferTypesTable.DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url: $url
            }, // JSON file to add data
            columns: [
                // columns according to JSON
                {data: 'id'},
                {data: 'DT_RowIndex'},
                {data: 'name'},
                {data: 'description'},
                {data: 'actions', orderable: false},
            ],
            columnDefs: [{
                targets: 4,
                width: '400px',

            }, {
                // For Checkboxes
                targets: 0,
                orderable: false,
                responsivePriority: 3,
                render: function (data, type, full, meta) {
                    return (
                        '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input dt-checkboxes" type="checkbox" value=' +
                        data +
                        ' id="checkbox' +
                        data +
                        '" /><label class="custom-control-label" for="checkbox' +
                        data +
                        '"></label></div>'
                    );
                },
                checkboxes: {
                    selectAllRender: '<div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                }
            },],
            order: [1, 'asc'],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'عرض _MENU_',
                zeroRecords: 'لا يوجد بيانات',
                info: "عرض الصفحات _PAGE_ من _PAGES_",
                infoEmpty: 'عرض 0 صفحات',
                search: '',
                searchPlaceholder: 'بحث..',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '<i class="las la-angle-double-right"></i>',
                    next: '<i class="las la-angle-double-left"></i>'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: '<span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" /> <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" /></svg></span>',
                className: 'add-new btn btn-light-primary fw-bolder btn-icon mt-50 white',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#modal_create_new',
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }

            },
                {
                    text: '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                        '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                        '        <rect x="0" y="0" width="24" height="24"/>\n' +
                        '        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>\n' +
                        '        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\n' +
                        '    </g>\n' +
                        '</svg><!--end::Svg Icon--></span>',
                    className: 'add-new btn btn-light-danger btn-icon mt-50 btnToggledtCheckType',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#modals-select',
                        'id': 'delete-all'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }

                },
            ],

        });
    }

    $(document).on('click', '.btnToggledtCheckType', function () {
        var id = [];
        $('#modals-delete-all').on('hide.bs.modal show.bs.modal', function (event) {
            var $activeElement = $(document.activeElement);

            if ($activeElement.is('[data-bs-toggle], [data-dismiss]')) {
                if ($activeElement[0].id == 'delete') {
                    $('.dt-checkboxes:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: $deleteAllurl,
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                toastr.success('تم الحذف بنجاح😍😍');
                                var deleteButton = document.getElementById('delete-all');
                                deleteButton.setAttribute("data-bs-target", "#modals-select");
                                dtTransferTypesTable.DataTable().ajax.reload();
                            }
                        });
                    } else {
                        $('#modals-select').modal('toggle');
                    }
                }
            }
        });

    });
});
