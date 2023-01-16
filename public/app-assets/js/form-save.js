var modernWizard = document.querySelector('.modern-wizard-example');

jQuery.extend(jQuery.validator.messages, {
    required: "الحقل مطلوب.",

});

function showDiv(divId, element) {

    document.getElementById(divId).style.display = element.value == "لا يوجد" ? 'none' : 'block';

}
if (typeof modernWizard !== undefined && modernWizard !== null) {
    var modernStepper = new Stepper(modernWizard);
    var form = $(modernWizard).find('form');

    form.each(function () {
        var $this = $(this);
        $this.validate({
            rules: {
                first_name: {required: true},
                second_name: {required: true},
                third_name: {required: true},
                last_name: {required: true},
                card_id: {required: true},
                mobile: {required: true},
                birth_date: {required: true},
                city_id: {required: true},
                town: {required: true},
                address: {required: true},
                application_date: {required: true},
                application_case_id: {required: true},
                arr_type: {required: true},
                theoretical_price: {required: true},
                practical_price: {required: true},
                drive_license_id: {required: true},
                transfer_type_id: {required: true},
                check_result_id: {required: true},
                check_date: {required: true},
                check_type_id: {required: true},
            }
        });
    });

    $(modernWizard)
        .on('click', '.btn-next', function (e) {
            var isValid = $(this).parent().siblings('form').valid();
            if (isValid) {
                var formData = new FormData($("#student_form")[0]);
                $("#error").text("");
                $.ajax({
                    type: "post",
                    enctype: 'multipart/form-data',
                    url: student_url,
                    dataType: 'json',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        toastr.success('تم الحفظ بنجاح😍😍');
                        document.getElementById('student_id').value = data.student_id;
                        document.getElementById('student_id1').value = data.student_id;

                        $("#error").hide();

                        modernStepper.next();
                    },
                    error: function (data) {
                        toastr.error('يرجى التاكد من ادخال البيانات كاملة');
                        var string = "";
                        $.each(data.responseJSON.errors, function (key, value) {
                            string = string + value[0] + "<br><br>";
                            $("#error").html(string);
                        });
                        $("#error").show();

                        e.preventDefault();
                    }
                });
            } else {
                e.preventDefault();
            }
        });


    $(modernWizard)
        .find('.btn-prev')
        .on('click', function () {
            modernStepper.previous();
        });

    $(modernWizard)
        .find('.btn-submit')
        .on('click', function () {
            var isValid = $(this).parent().siblings('form').valid();
            if (isValid) {
                var formData = new FormData($("#application_form")[0]);
                $("#error").text("");
                $.ajax({
                    type: "post",
                    enctype: 'multipart/form-data',
                    url: app_url,
                    dataType: 'json',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        toastr.success('تم الحفظ بنجاح😍😍');
                        $("#error").hide();

                        location.href = '/admin/applications';
                    },
                    error: function (data) {
                        toastr.error('يرجى التاكد من ادخال البيانات كاملة');
                        var string = "";
                        $.each(data.responseJSON.errors, function (key, value) {
                            string = string + value[0] + "<br><br>";
                            $("#error").html(string);
                        });
                        $("#error").show();

                        e.preventDefault();
                    }
                });
            } else {
                e.preventDefault();
            }

        });

}


