<!--begin::Aside column-->
<div class="w-100 flex-lg-row-auto w-lg-300px mb-7 me-7 me-lg-10">
    <!--begin::Order details-->
    <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h2>{{__('بيانات الطلب')}}</h2>
            </div>
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <div class="d-flex flex-column gap-10">
                <!--begin::Input group-->
                <div class="fv-row">
                    <!--begin::Label-->
                    <label class="form-label">{{__('رقم الطلب')}}</label>
                    <!--end::Label-->
                    <!--begin::Auto-generated ID-->
                    <div class="fw-bolder fs-3">{{$app_id}}#</div>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row">
                    <!--begin::Label-->
                    <label class="required form-label">{{__('حالة الطلب')}}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <select name="application_case_id" id="application_case_id" aria-label="اختر الحالة" data-control="select2" data-placeholder="اختر الحالة..." class="form-select form-select-solid form-select-lg fw-bold @error('application_case_id') is-invalid @enderror">
                        <option value="">اختر الحالة...</option>
                        @foreach ($application_cases as $case)
                            <option value="{{ $case->id }}"
                                    @if( $case->id == old('application_case_id', $app->application_case_id) ) selected @endif>{{ $case->name }}</option>
                        @endforeach
                    </select>
                    <!--end::Col-->
                    <!--begin::Description-->
                    <div class="text-muted fs-7">{{__('ادخل حالة الطلب.')}}</div>
                    <!--end::Description-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row">
                    <!--begin::Label-->
                    <label class="required form-label">{{__('الاتفاق')}}</label>
                    <!--end::Label-->
                    <!--begin::Options-->
                    <div class="d-flex align-items-center mt-3 ">
                        <!--begin::Option-->
                        <div class="form-check form-check-custom form-check-solid me-10">
                            <input class="form-check-input" type="radio" name="arr_type" value="دروس" id="listion" @if( 'دروس' == old('arr_type', $app->arr_type) ) checked @endif checked>
                            <label class="form-check-label" for="male">{{__('دروس')}}</label>
                        </div>
                        <!--end::Option-->
                        <!--begin::Option-->
                        <div class="form-check form-check-custom form-check-solid me-10">
                            <input class="form-check-input" type="radio" name="arr_type" value="مقاولة" id="Nlistion"@if( 'مقاولة' == old('arr_type', $app->arr_type) ) checked @endif>
                            <label class="form-check-label" for="female">{{__('مقاولة')}}</label>
                        </div>
                        <!--end::Option-->
                    </div>
                    <!--end::Options-->
                    <!--begin::Description-->
                    <div class="text-muted fs-7">{{__('حدد نوع الاتفاق.')}}</div>
                    <!--end::Description-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row">
                    <!--begin::Label-->
                    <label class="required form-label">{{__('تاريخ الطلب')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="application_date" class="form-control form-control-lg form-control-solid @error('application_date') is-invalid @enderror pickadate-ar"  value="{{ old('application_date', $app->application_date) }}" placeholder="YYYY-MM-DD"
                           readonly="readonly"/>
                    @error('application_date')<div class="invalid-feedback"> {{$message}} </div> @enderror
                    <!--end::Input-->

                    <!--begin::Description-->
                    <div class="text-muted fs-7">أدخل تاريخ انشاء الطلب.</div>
                    <!--end::Description-->
                </div>
                <!--end::Input group-->
            </div>
        </div>
        <!--end::Card header-->
    </div>
    <!--end::Order details-->
</div>
<!--end::Aside column-->
<!--begin::Main column-->
<div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">
    <!--begin::Order details-->
    <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h2>{{__('الطلاب')}}</h2>
            </div>
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Billing address-->
            <div class="d-flex flex-column gap-5 gap-md-7">

                <!--end::Input group-->
                <!--begin::Checkbox-->
                <div class="form-check form-check-custom form-check-solid @if($app->id) d-none @endif">
                    <input class="form-check-input" type="checkbox" name="old_student" id="old_student" value = 'old' @if($old_student == 1 && old('old_student') != 'old')  @elseif($old_student == 2 && old('old_student') =='old') checked="checked" @else checked="checked" @endif />
                    <label class="form-check-label" for="old_student">{{__('طالب موجود.')}}</label>
                </div>
                <!--end::Checkbox-->
                <!--begin::Input group-->
                <div class="fv-row @if($old_student == 1 && old('old_student') != 'old') d-none @elseif($old_student == 2 && old('old_student') =='old')  @else @endif"  id="student_id_select" >
                    <!--begin::Label-->
                    <label class="required form-label">{{__('طالب')}}</label>
                    <!--end::Label-->
                    <!--begin::Select2-->
                    <select class="form-select form-select-solid mb-2 @error('student_id')is-invalid @enderror " data-control="select2" data-hide-search="true" data-placeholder="أختر طالب" name="student_id" id="student_id">
                        <option></option>

                        @foreach ($students as $student_data)
                            <option value="{{ $student_data->id }}"
                                    @if( $student_data->id == old('student_id', $app->student_id) ) selected @endif>{{ $student_data->getFullName() }}</option>
                        @endforeach

                    </select>
                    <!--end::Select2-->

                    <!--begin::Description-->
                    <div class="text-muted fs-7">{{__('اختر طالب ل انشاء طلب.')}}</div>
                    <!--end::Description-->

                </div>
                <!--end::Input group-->

                <!--begin::Shipping address-->
                <div class=" @if($old_student == 1 && old('old_student') != 'old') @elseif($old_student == 2 && old('old_student') =='old') d-none @else d-none @endif d-flex flex-column gap-5 gap-md-7" id="old_student_form" >
                    <!--begin::Title-->
                    <div class="fs-3 fw-bolder mb-n2">{{__('أنشاء طالب جديد')}}</div>
                    <!--end::Title-->
                    <!--begin::Title-->
                    <div class="fs-3 fw-bolder mb-n2">{{__('المعلومات الشخصية')}}</div>
                    <!--end::Title-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-column flex-md-row gap-5">
                        <div class="fv-row flex-row-fluid">
                            <!--begin::Label-->
                            <label class="required form-label">{{__('الأسم الأول')}}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="first_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('first_name') is-invalid @enderror" placeholder="الأسم الأول" value="{{ old('first_name', $student->first_name) }}" />
                            @error('first_name')<div class="invalid-feedback"> {{$message}} </div> @enderror
                            <!--end::Input-->
                        </div>
                        <div class="fv-row flex-row-fluid">
                            <!--begin::Label-->
                            <label class="required form-label">{{__('الأسم الثاني')}}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="second_name" class="form-control form-control-lg form-control-solid @error('second_name') is-invalid @enderror" placeholder="الأسم الثاني" value="{{ old('second_name', $student->second_name) }}" />
                            @error('second_name')<div class="invalid-feedback"> {{$message}} </div> @enderror
                            <!--end::Input-->
                        </div>
                        <div class="fv-row flex-row-fluid">
                            <!--begin::Label-->
                            <label class="required form-label">{{__('الأسم الثالث')}}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="third_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('first_name') is-invalid @enderror" placeholder="الأسم الثالث" value="{{ old('third_name', $student->third_name) }}" />
                            @error('third_name')<div class="invalid-feedback"> {{$message}} </div> @enderror
                            <!--end::Input-->
                        </div>
                        <div class="flex-row-fluid">
                            <!--begin::Label-->
                            <label class="form-label">{{__('الأسم الرابع')}}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="last_name" class="form-control form-control-lg form-control-solid @error('last_name') is-invalid @enderror" placeholder="الأسم الرابع" value="{{ old('last_name', $student->last_name) }}" />
                            @error('last_name')<div class="invalid-feedback"> {{$message}} </div> @enderror
                            <!--end::Input-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-column flex-md-row gap-5">
                        <div class="fv-row flex-row-fluid">
                            <!--begin::Label-->
                            <label class="required form-label">{{__('البطاقة')}}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="card_id" class="form-control form-control-lg form-control-solid @error('card_id') is-invalid @enderror" placeholder="رقم البطاقة" value="{{ old('card_id', $student->card_id) }}" />
                            @error('card_id')<div class="invalid-feedback"> {{$message}} </div> @enderror
                            <!--end::Input-->
                        </div>
                        <div class="fv-row flex-row-fluid">
                            <!--begin::Label-->
                            <label class="required form-label">{{__('الموبايل')}}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="mobile" class="form-control form-control-lg form-control-solid @error('mobile') is-invalid @enderror" placeholder="رقم الموبايل" value="{{ old('mobile', $student->mobile) }}" />
                            @error('mobile')<div class="invalid-feedback"> {{$message}} </div> @enderror
                            <!--end::Input-->
                        </div>

                        <div class="fv-row flex-row-fluid">
                            <!--begin::Label-->
                            <label class="required form-label">{{__('النوع')}}</label>
                            <!--end::Label-->
                            <!--begin::Options-->
                            <div class="d-flex align-items-center mt-3 ">
                                <!--begin::Option-->
                                <div class="form-check form-check-custom form-check-solid me-10">
                                    <input class="form-check-input" type="radio" name="gender" value="ذكر" id="male" @if( 'ذكر' == old('gender', $student->gender) ) checked @endif checked>
                                    <label class="form-check-label" for="male">{{__('ذكر')}}</label>
                                </div>
                                <!--end::Option-->
                                <!--begin::Option-->
                                <div class="form-check form-check-custom form-check-solid me-10">
                                    <input class="form-check-input" type="radio" name="gender" value="أنثى" id="female" @if( 'أنثى' == old('gender', $student->gender) ) checked @endif>
                                    <label class="form-check-label" for="female">{{__('أنثى')}}</label>
                                </div>
                                <!--end::Option-->
                            </div>
                            <!--end::Options-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-column flex-md-row gap-5">
                        <div class="fv-row flex-row-fluid">
                            <!--begin::Label-->
                            <label class="required form-label">{{__('تاريخ الميلاد')}}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="birth_date" class="form-control form-control-lg form-control-solid @error('birth_date') is-invalid @enderror pickadate-ar"  value="{{ old('birth_date', $student->birth_date) }}" placeholder="YYYY-MM-DD"
                                   readonly="readonly"/>
                            @error('birth_date')<div class="invalid-feedback"> {{$message}} </div> @enderror
                            <!--end::Input-->

                        </div>
                        <div class="fv-row flex-row-fluid">

                        </div>
                        <div class="fv-row flex-row-fluid">

                        </div>
                        <div class="fv-row flex-row-fluid">

                        </div>
                        <div class="fv-row flex-row-fluid">

                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Title-->
                    <div class="fs-3 fw-bolder mb-n2">{{__('العنوان')}}</div>
                    <!--end::Title-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-column flex-md-row gap-5">
                        <div class="fv-row flex-row-fluid">
                            <!--begin::Label-->
                            <label class="required form-label">{{__('المدينة')}}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <select name="city_id" id="city_id" aria-label="اختر مدينة" data-control="select2" data-placeholder="اختر مدينة..." class="form-select form-select-solid form-select-lg fw-bold @error('city_id') is-invalid @enderror">
                                <option value="">اختر مدينة...</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}"
                                            @if( $city->id == old('city_id', $student->city_id) ) selected @endif>{{ $city->name }}</option>
                                @endforeach
                            </select>
                            <!--end::Col-->
                        </div>
                        <div class="fv-row flex-row-fluid">
                            <!--begin::Label-->
                            <label class="required form-label">{{__('الحي')}}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="town" class="form-control form-control-lg form-control-solid @error('town') is-invalid @enderror" placeholder="اسم الحي" value="{{ old('town', $student->town) }}" />
                            @error('town')<div class="invalid-feedback"> {{$message}} </div> @enderror
                            <!--end::Input-->
                        </div>
                        <div class="fv-row flex-row-fluid">
                            <!--begin::Label-->
                            <label class="required form-label">{{__('العنوان')}}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="address" class="form-control form-control-lg form-control-solid @error('address') is-invalid @enderror" placeholder="تفاصيل العنوان" value="{{ old('address', $student->address) }}" />
                            @error('address')<div class="invalid-feedback"> {{$message}} </div> @enderror
                            <!--end::Input-->
                        </div>
                    </div>

                </div>
                <!--end::Shipping address-->
            </div>
            <!--end::Billing address-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Order details-->
    <!--begin::Order details-->
    <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h2>{{__('بيانات الطلب')}}</h2>
            </div>
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Billing address-->
            <div class="d-flex flex-column gap-5 gap-md-7">

                <!--begin::Title-->
                <div class="fs-3 fw-bolder mb-n2">{{__('الرخصة')}}</div>
                <!--end::Title-->
                <!--begin::Input group-->
                <div class="d-flex flex-column flex-md-row gap-5">
                    <div class="fv-row flex-row-fluid">
                        <!--begin::Label-->
                        <label class="required form-label">{{__('نوع الرخصة')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <select name="drive_license_id" id="drive_license_id" aria-label="اختر رخصة" data-control="select2" data-placeholder="اختر رخصة..." class="form-select form-select-solid form-select-lg fw-bold @error('drive_license_id') is-invalid @enderror">
                            <option value="">اختر رخصة...</option>
                            @foreach ($drive_license  as $license)
                                <option value="{{ $license->id }}"
                                        @if( $license->id == old('drive_license_id', $app->drive_license_id) ) selected @endif>{{ $license->name }}</option>
                            @endforeach
                        </select>
                        <!--end::Col-->
                    </div>
                    <div class="fv-row flex-row-fluid">
                        <!--begin::Label-->
                        <label class="required form-label">{{__('سعر النظري')}}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="number" name="theoretical_price" min='0'class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('theoretical_price') is-invalid @enderror" placeholder="سعر النظري" value="{{ old('theoretical_price', $app->theoretical_price) }}" />
                        @error('theoretical_price')<div class="invalid-feedback"> {{$message}} </div> @enderror
                        <!--end::Input-->
                    </div>
                    <div class="flex-row-fluid">
                        <!--begin::Label-->
                        <label class="form-label">{{__('سعر العملي')}}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="number" name="practical_price" min='0' class="form-control form-control-lg form-control-solid @error('practical_price') is-invalid @enderror" placeholder="سعر العملي" value="{{ old('practical_price', $app->practical_price) }}" />
                        @error('practical_price')<div class="invalid-feedback"> {{$message}} </div> @enderror
                        <!--end::Input-->
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Title-->
                <div class="fs-3 fw-bolder mb-n2">{{__('النقل')}}</div>
                <!--end::Title-->
                <!--begin::Input group-->
                <div class="d-flex flex-column flex-md-row gap-5">
                    <div class="fv-row flex-row-fluid">
                        <!--begin::Label-->
                        <label class="required form-label">{{__('عمليه النقل')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <select name="transfer_type_id" id="transfer_type_id" aria-label="لا يوجد" data-control="select2" data-placeholder="لا يوجد..." class="form-select form-select-solid form-select-lg fw-bold @error('transfer_type_id') is-invalid @enderror" onchange="showDiv('hidden_div','hidden_div2', this)">
                            <option value="لا يوجد"
                                    @if( "لا يوجد" == old('transfer_type_id') || $app->transfer_type_id == null) selected @endif>لا يوجد</option>
                            @foreach ($transfer_type as $type)
                                <option value="{{ $type->id }}"
                                        @if( $type->id == old('transfer_type_id', $app->transfer_type_id) ) selected @endif>{{ $type->name }}</option>
                            @endforeach
                        </select>
                        <!--end::Col-->
                    </div>
                    <div class="fv-row flex-row-fluid " id="hidden_div"@if($transfer == 1) style="display: block;"  @elseif($app->transfer_type_id == null) style="display: none;" @else style="display: block;"  @endif>
                        <!--begin::Label-->
                        <label class="required form-label">{{__('تاريخ النقل')}}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="transfer_date" class="form-control form-control-lg form-control-solid @error('transfer_date') is-invalid @enderror pickadate-ar"  value="{{ old('transfer_date', $app->transfer_date) }}" placeholder="YYYY-MM-DD"
                               readonly="readonly"/>
                        @error('transfer_date')<div class="invalid-feedback"> {{$message}} </div> @enderror
                        <!--end::Input-->

                    </div>
                    <div class="fv-row flex-row-fluid " id="hidden_div2" @if($transfer == 1) style="display: block;"  @elseif($app->transfer_type_id == null) style="display: none;" @else style="display: block;"  @endif>
                        <!--begin::Label-->
                        <label class="required form-label">{{__('أسم المدرسة')}}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="transfer_from" class="form-control form-control-lg form-control-solid @error('transfer_from') is-invalid @enderror" placeholder="أسم المدرسة" value="{{ old('transfer_from', $app->transfer_from) }}" />
                        @error('transfer_from')<div class="invalid-feedback"> {{$message}} </div> @enderror
                        <!--end::Input-->
                    </div>

                </div>
                <!--end::Input group-->
                <!--begin::Title-->
                <div class="fs-3 fw-bolder mb-n2">{{__('الفحص')}}</div>
                <!--end::Title-->
                <!--begin::Input group-->
                <div class="d-flex flex-column flex-md-row gap-5">
                    <div class="fv-row flex-row-fluid">
                        <!--begin::Label-->
                        <label class="required form-label">{{__('نوع الفحص')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <select name="check_type_id" id="check_type_id" aria-label="اختر نوع" data-control="select2" data-placeholder="اختر نوع..." class="form-select form-select-solid form-select-lg fw-bold @error('check_type_id') is-invalid @enderror">
                            <option value="">اختر نوع...</option>
                            @foreach ($check_type as $type)
                                <option value="{{ $type->id }}"
                                        @if( $type->id == old('check_type_id', $app->check_type_id) ) selected @endif>{{ $type->name }}</option>
                            @endforeach
                        </select>
                        <!--end::Col-->
                    </div>
                    <div class="fv-row flex-row-fluid">
                        <!--begin::Label-->
                        <label class="required form-label">{{__('تاريخ الفحص')}}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="check_date" class="form-control form-control-lg form-control-solid @error('check_date') is-invalid @enderror pickadate-ar"  value="{{ old('check_date', $app->check_date) }}" placeholder="YYYY-MM-DD"
                               readonly="readonly"/>
                        @error('check_date')<div class="invalid-feedback"> {{$message}} </div> @enderror
                        <!--end::Input-->

                    </div>
                    <div class="fv-row flex-row-fluid">
                        <!--begin::Label-->
                        <label class="required form-label">{{__('نتيجة الفحص')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <select name="check_result_id" id="check_result_id" aria-label="اختر نتيجة" data-control="select2" data-placeholder="اختر نتيجة..." class="form-select form-select-solid form-select-lg fw-bold @error('check_result_id') is-invalid @enderror">
                            <option value="">اختر نتيجة...</option>
                            @foreach ($check_result as $result)
                                <option value="{{ $result->id }}"
                                        @if( $result->id == old('check_result_id', $app->check_result_id) ) selected @endif>{{ $result->name }}</option>
                            @endforeach
                        </select>
                        <!--end::Col-->
                    </div>

                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="d-flex flex-column flex-md-row gap-5">
                    <div class="fv-row flex-row-fluid">
                        <!--begin::Label-->
                        <label class="required form-label">{{__('ملاحظات')}}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <textarea name="note" class="form-control form-control-lg form-control-solid @error('note') is-invalid @enderror "cols="30" rows="5"  value="{{ old('note', $app->note) }}" placeholder="ادخل ملاحظتك"
                        >{{old('note', $app->note) }}</textarea>
                        @error('transfer_date')<div class="invalid-feedback"> {{$message}} </div> @enderror
                        <!--end::Input-->
                    </div>


                </div>
                <!--end::Input group-->
            </div>
            <!--end::Billing address-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Order details-->
    <div class="d-flex">
        <!--begin::Button-->
        {{--                        <a href="/metronic8/demo11/../demo11/rtl/apps/ecommerce/catalog/products.html" id="kt_ecommerce_edit_order_cancel" class="btn btn-light me-5">Cancel</a>--}}
        <!--end::Button-->
        <!--begin::Button-->
        <button type="submit" id="kt_ecommerce_edit_order_submit" class="btn btn-primary">
            <span class="indicator-label">{{__('حفظ')}}</span>
            <span class="indicator-progress">{{__('يتم الحفظ...')}}
											<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
        <!--end::Button-->
    </div>
</div>
<!--end::Main column-->
