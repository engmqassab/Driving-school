<div class="card-body border-top p-9">

<div class="d-flex flex-column gap-5 gap-md-7">
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
            <input type="text" name="first_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('first_name') is-invalid @enderror" placeholder="الأسم الأول" value="{{ old('first_name', $item->first_name) }}" />
            @error('first_name')<div class="invalid-feedback"> {{$message}} </div> @enderror
            <!--end::Input-->
        </div>
        <div class="fv-row flex-row-fluid">
            <!--begin::Label-->
            <label class="required form-label">{{__('الأسم الثاني')}}</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" name="second_name" class="form-control form-control-lg form-control-solid @error('second_name') is-invalid @enderror" placeholder="الأسم الثاني" value="{{ old('second_name', $item->second_name) }}" />
            @error('second_name')<div class="invalid-feedback"> {{$message}} </div> @enderror
            <!--end::Input-->
        </div>
        <div class="fv-row flex-row-fluid">
            <!--begin::Label-->
            <label class="required form-label">{{__('الأسم الثالث')}}</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" name="third_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('first_name') is-invalid @enderror" placeholder="الأسم الثالث" value="{{ old('third_name', $item->third_name) }}" />
            @error('third_name')<div class="invalid-feedback"> {{$message}} </div> @enderror
            <!--end::Input-->
        </div>
        <div class="flex-row-fluid">
            <!--begin::Label-->
            <label class="form-label">{{__('الأسم الرابع')}}</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" name="last_name" class="form-control form-control-lg form-control-solid @error('last_name') is-invalid @enderror" placeholder="الأسم الرابع" value="{{ old('last_name', $item->last_name) }}" />
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
            <input type="text" name="card_id" class="form-control form-control-lg form-control-solid @error('card_id') is-invalid @enderror" placeholder="رقم البطاقة" value="{{ old('card_id', $item->card_id) }}" />
            @error('card_id')<div class="invalid-feedback"> {{$message}} </div> @enderror
            <!--end::Input-->
        </div>
        <div class="fv-row flex-row-fluid">
            <!--begin::Label-->
            <label class="required form-label">{{__('الموبايل')}}</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" name="mobile" class="form-control form-control-lg form-control-solid @error('mobile') is-invalid @enderror" placeholder="رقم الموبايل" value="{{ old('mobile', $item->mobile) }}" />
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
                    <input class="form-check-input" type="radio" name="gender" value="ذكر" id="male" @if( 'ذكر' == old('gender', $item->gender) ) checked @endif checked>
                    <label class="form-check-label" for="male">{{__('ذكر')}}</label>
                </div>
                <!--end::Option-->
                <!--begin::Option-->
                <div class="form-check form-check-custom form-check-solid me-10">
                    <input class="form-check-input" type="radio" name="gender" value="أنثى" id="female" @if( 'أنثى' == old('gender', $item->gender) ) checked @endif>
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
            <input type="text" name="birth_date" class="form-control form-control-lg form-control-solid @error('birth_date') is-invalid @enderror pickadate-ar"  value="{{ old('birth_date', $item->birth_date) }}" placeholder="YYYY-MM-DD"
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
                            @if( $city->id == old('city_id', $item->city_id) ) selected @endif>{{ $city->name }}</option>
                @endforeach
            </select>
            <!--end::Col-->
        </div>
        <div class="fv-row flex-row-fluid">
            <!--begin::Label-->
            <label class="required form-label">{{__('الحي')}}</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" name="town" class="form-control form-control-lg form-control-solid @error('town') is-invalid @enderror" placeholder="اسم الحي" value="{{ old('town', $item->town) }}" />
            @error('town')<div class="invalid-feedback"> {{$message}} </div> @enderror
            <!--end::Input-->
        </div>
        <div class="fv-row flex-row-fluid">
            <!--begin::Label-->
            <label class="required form-label">{{__('العنوان')}}</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="text" name="address" class="form-control form-control-lg form-control-solid @error('address') is-invalid @enderror" placeholder="تفاصيل العنوان" value="{{ old('address', $item->address) }}" />
            @error('address')<div class="invalid-feedback"> {{$message}} </div> @enderror
            <!--end::Input-->
        </div>
    </div>
    <!--end::Input group-->
    <!--begin::Actions-->
    <div class="card-footer d-flex  py-6 px-9">
        <button type="reset" class="btn btn-light btn-active-light-primary me-2">{{__('تهيئة')}}</button>
        <!--begin::Button-->
        <button type="submit" id="kt_ecommerce_edit_order_submit" class="btn btn-primary">
            <span class="indicator-label">{{__('حفظ')}}</span>
            <span class="indicator-progress">{{__('يتم الحفظ...')}}
											<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
        <!--end::Button-->
    </div>
    <!--end::Actions-->
</div>
<!--end::Billing address-->
</div>
