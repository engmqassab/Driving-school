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

            <!--begin::Sign-in Method-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <x-alert />
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('اعدادات الحساب')}}</h3>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Content-->
                <div id="kt_account_signin_method" class="collapse show">
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <!--begin::Email Address-->
                        <div class="d-flex flex-wrap align-items-center">
                            <!--begin::Label-->
                            <div id="kt_signin_email">
                                <div class="fs-6 fw-bolder mb-1">{{__('اسم المستخدم')}}</div>
                                <div class="fw-bold text-gray-600">{{ Auth::user()->name }}</div>
                                <div class="fs-6 fw-bolder mb-1">{{__('الأيميل')}}</div>
                                <div class="fw-bold text-gray-600">{{ Auth::user()->email }}</div>
                            </div>
                            <!--end::Label-->

                            <!--begin::Edit-->
                            <div id="kt_signin_email_edit" class="flex-row-fluid d-none">

                                <!--begin::Form-->
                                <form id="" class="form" action="{{ route('admin.profile.updatePersonal') }}" method="POST" novalidate="novalidate" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-6">
                                        <div class="col-lg-6 mb-4 mb-lg-0">
                                            <div class="fv-row mb-0">
                                                <label for="name" class="form-label fs-6 fw-bolder mb-3">{{__('الأسم')}}</label>
                                                <input type="text" class="form-control form-control-lg form-control-solid  @error('name') is-invalid @enderror" id="name" placeholder="الأسم" name="name" value="{{ old('name', Auth::user()->name) }}" />
                                            </div>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>


                                        <div class="col-lg-6 mb-4 mb-lg-0">
                                            <div class="fv-row mb-0">
                                                <label for="username" class="form-label fs-6 fw-bolder mb-3">{{__('اسم المستخدم')}}</label>
                                                <input type="text" class="form-control form-control-lg form-control-solid @error('username') is-invalid @enderror" id="username" placeholder="اسم المستخدم" name="username" value="{{ old('name', Auth::user()->username) }}" />
                                            </div>
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-4 mb-lg-0">
                                            <div class="fv-row mb-0">
                                                <label for="email" class="form-label fs-6 fw-bolder mb-3">{{__('الأيميل')}}</label>
                                                <input type="text" class="form-control form-control-lg form-control-solid  @error('email') is-invalid @enderror" id="email" placeholder="الأيميل" name="email" value="{{ old('name', Auth::user()->email) }}"/>
                                            </div>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="d-flex">
                                        <button data-bs-toggle="modal" data-bs-target="#checkPasswordModal" type="button" class="btn btn-primary me-2 px-6">{{__('تحديث البيانات')}}</button>
                                        <button id="kt_signin_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">{{__('الغاء')}}</button>
                                    </div>

                                    <!--begin::Modal - Two-factor authentication-->
                                    <div class="modal fade" id="checkPasswordModal" tabindex="-1" aria-hidden="true">
                                        <!--begin::Modal header-->
                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                            <!--begin::Modal content-->
                                            <div class="modal-content">
                                                <!--begin::Modal header-->
                                                <div class="modal-header flex-stack">
                                                    <!--begin::Title-->
                                                    <h2>{{__('حفظ التغييرات')}}</h2>
                                                    <!--end::Title-->
                                                    <!--begin::Close-->
                                                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                        <span class="svg-icon svg-icon-1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
														<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
													</svg>
												</span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <!--end::Close-->
                                                </div>
                                                <!--begin::Modal header-->
                                                <!--begin::Modal body-->
                                                <div class="modal-body scroll-y pt-10 pb-15 px-lg-17">
                                                    <!--begin::Options-->
                                                    <div data-kt-element="options">
                                                        <!--begin::Notice-->
                                                        <p class="text-muted fs-5 fw-bold mb-10">{{__('ادخل كلمة المرور الحالية للتعديل على البيانات')}}</p>
                                                        <!--end::Notice-->
                                                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                                                            <!--begin::Input group-->
                                                            <div class="fv-row mb-7">

                                                                <!--begin::Input-->
                                                                <input type="password" name="password" id="password" class="form-control form-control-solid  @error('password') is-invalid @enderror mb-3 mb-lg-0" placeholder="كلمة المرور الحالية"/>
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->

                                                        </div>
                                                        <!--end::Scroll-->
                                                        <!--begin::Action-->
                                                        <button class="btn btn-primary w-100" data-kt-element="options-select" type="submit">{{__('حفظ الاعدادات الجديدة')}}</button>
                                                        <!--end::Action-->
                                                    </div>
                                                    <!--end::Options-->

                                                </div>
                                                <!--begin::Modal body-->
                                            </div>
                                            <!--end::Modal content-->
                                        </div>
                                        <!--end::Modal header-->
                                    </div>
                                    <!--end::Modal - Two-factor authentication-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Edit-->
                            <!--begin::Action-->
                            <div id="kt_signin_email_button" class="ms-auto">
                                <button class="btn btn-light btn-active-light-primary">{{__('تغيير الاعدادات')}}</button>
                            </div>
                            <!--end::Action-->
                        </div>
                        <!--end::Email Address-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-6"></div>
                        <!--end::Separator-->
                        <!--begin::Password-->
                        <div class="d-flex flex-wrap align-items-center mb-10">
                            <!--begin::Label-->
                            <div id="kt_signin_password">
                                <div class="fs-6 fw-bolder mb-1">{{__("كلمة المرور")}}</div>
                                <div class="fw-bold text-gray-600">************</div>
                            </div>
                            <!--end::Label-->
                            <!--begin::Edit-->
                            <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                                <!--begin::Form-->
                                <form id="" class="form" novalidate="novalidate"action="{{ route('admin.profile.updatePassword') }}"
                                      method="POST">
                                    @csrf
                                    <div class="row mb-1">
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0">
                                                <label for="current_password" class="form-label fs-6 fw-bolder mb-3">{{__('كلمة المرور القديمة')}}</label>
                                                <input type="password" class="form-control form-control-lg form-control-solid @error('current_password') is-invalid @enderror" name="current_password" id="current_password" />
                                            </div>
                                            @error('current_password')
                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0">
                                                <label for="password" class="form-label fs-6 fw-bolder mb-3">{{__('كلمة المرور جديدة')}}</label>
                                                <input type="password" class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" name="password" id="password" />
                                            </div>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0">
                                                <label for="password_confirmation" class="form-label fs-6 fw-bolder mb-3">{{__('تأكيد كلمة المرور جديدة')}}</label>
                                                <input type="password" class="form-control form-control-lg form-control-solid @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" />

                                                @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-text mb-5">{{__('كلمة المرور الجديدة يجب ان لا تقل عن 8 حروف')}}</div>
                                    <div class="d-flex">
                                        <button id="kt_password_submit" type="button" data-bs-toggle="modal" data-bs-target="#checkPasswModal" class="btn btn-primary me-2 px-6">{{__('تغيير كلمة المرور')}}</button>
                                        <button id="kt_password_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">
                                            {{__('الغاء')}}</button>
                                    </div>
                                    <!--begin::Modal - Two-factor authentication-->
                                    <div class="modal fade" id="checkPasswModal" tabindex="-1" aria-hidden="true">
                                        <!--begin::Modal header-->
                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                            <!--begin::Modal content-->
                                            <div class="modal-content">
                                                <!--begin::Modal header-->
                                                <div class="modal-header flex-stack">
                                                    <!--begin::Title-->
                                                    <h2>{{__('حفظ التغييرات')}}</h2>
                                                    <!--end::Title-->
                                                    <!--begin::Close-->
                                                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                        <span class="svg-icon svg-icon-1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
														<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
													</svg>
												</span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <!--end::Close-->
                                                </div>
                                                <!--begin::Modal header-->
                                                <!--begin::Modal body-->
                                                <div class="modal-body scroll-y pt-10 pb-15 px-lg-17">
                                                    <!--begin::Options-->
                                                    <div data-kt-element="options">
                                                        <!--begin::Notice-->
                                                        <p class="text-muted fs-5 fw-bold mb-10">{{__('ادخل كلمة المرور الحالية للتعديل على البيانات')}}</p>
                                                        <!--end::Notice-->
                                                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                                                            <!--begin::Input group-->
                                                            <div class="fv-row mb-7">

                                                                <!--begin::Input-->
                                                                <input type="password" name="old_password" id="old_password" class="form-control form-control-solid @error('old_password') is-invalid @enderror mb-3 mb-lg-0" placeholder="كلمة المرور الحالية"/>
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->

                                                        </div>
                                                        <!--end::Scroll-->
                                                        <!--begin::Action-->
                                                        <button class="btn btn-primary w-100" data-kt-element="options-select" type="submit">{{__('حفظ كلمة المرور')}}</button>
                                                        <!--end::Action-->
                                                    </div>
                                                    <!--end::Options-->

                                                </div>
                                                <!--begin::Modal body-->
                                            </div>
                                            <!--end::Modal content-->
                                        </div>
                                        <!--end::Modal header-->
                                    </div>
                                    <!--end::Modal - Two-factor authentication-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Edit-->
                            <!--begin::Action-->
                            <div id="kt_signin_password_button" class="ms-auto">
                                <button class="btn btn-light btn-active-light-primary">{{__('تغيير كلمة المرور')}}</button>
                            </div>
                            <!--end::Action-->
                        </div>
                        <!--end::Password-->

                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Sign-in Method-->

            <!--begin::Modal - Two-factor authentication-->
            <div class="modal fade" id="kt_modal_two_factor_authentication" tabindex="-1" aria-hidden="true">
                <!--begin::Modal header-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header flex-stack">
                            <!--begin::Title-->
                            <h2>Choose An Authentication Method</h2>
                            <!--end::Title-->
                            <!--begin::Close-->
                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
														<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
													</svg>
												</span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--begin::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y pt-10 pb-15 px-lg-17">
                            <!--begin::Options-->
                            <div data-kt-element="options">
                                <!--begin::Notice-->
                                <p class="text-muted fs-5 fw-bold mb-10">In addition to your username and password, you’ll have to enter a code (delivered via app or SMS) to log into your account.</p>
                                <!--end::Notice-->
                                <!--begin::Wrapper-->
                                <div class="pb-10">
                                    <!--begin::Option-->
                                    <input type="radio" class="btn-check" name="auth_option" value="apps" checked="checked" id="kt_modal_two_factor_authentication_option_1" />
                                    <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-5" for="kt_modal_two_factor_authentication_option_1">
                                        <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
                                        <span class="svg-icon svg-icon-4x me-4">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path opacity="0.3" d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z" fill="black" />
																<path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z" fill="black" />
															</svg>
														</span>
                                        <!--end::Svg Icon-->
                                        <span class="d-block fw-bold text-start">
															<span class="text-dark fw-bolder d-block fs-3">Authenticator Apps</span>
															<span class="text-muted fw-bold fs-6">Get codes from an app like Google Authenticator, Microsoft Authenticator, Authy or 1Password.</span>
														</span>
                                    </label>
                                    <!--end::Option-->
                                    <!--begin::Option-->
                                    <input type="radio" class="btn-check" name="auth_option" value="sms" id="kt_modal_two_factor_authentication_option_2" />
                                    <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center" for="kt_modal_two_factor_authentication_option_2">
                                        <!--begin::Svg Icon | path: icons/duotune/communication/com003.svg-->
                                        <span class="svg-icon svg-icon-4x me-4">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="black" />
																<path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="black" />
															</svg>
														</span>
                                        <!--end::Svg Icon-->
                                        <span class="d-block fw-bold text-start">
															<span class="text-dark fw-bolder d-block fs-3">SMS</span>
															<span class="text-muted fw-bold fs-6">We will send a code via SMS if you need to use your backup login method.</span>
														</span>
                                    </label>
                                    <!--end::Option-->
                                </div>
                                <!--end::Options-->
                                <!--begin::Action-->
                                <button class="btn btn-primary w-100" data-kt-element="options-select">Continue</button>
                                <!--end::Action-->
                            </div>
                            <!--end::Options-->
                            <!--begin::Apps-->
                            <div class="d-none" data-kt-element="apps">
                                <!--begin::Heading-->
                                <h3 class="text-dark fw-bolder mb-7">Authenticator Apps</h3>
                                <!--end::Heading-->
                                <!--begin::Description-->
                                <div class="text-gray-500 fw-bold fs-6 mb-10">Using an authenticator app like
                                    <a href="https://support.google.com/accounts/answer/1066447?hl=en" target="_blank">Google Authenticator</a>,
                                    <a href="https://www.microsoft.com/en-us/account/authenticator" target="_blank">Microsoft Authenticator</a>,
                                    <a href="https://authy.com/download/" target="_blank">Authy</a>, or
                                    <a href="https://support.1password.com/one-time-passwords/" target="_blank">1Password</a>, scan the QR code. It will generate a 6 digit code for you to enter below.
                                    <!--begin::QR code image-->
                                    <div class="pt-5 text-center">
                                        <img src="assets/media/misc/qr.png" alt="" class="mw-150px" />
                                    </div>
                                    <!--end::QR code image--></div>
                                <!--end::Description-->
                                <!--begin::Notice-->
                                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-10 p-6">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                                    <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
															<rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black" />
															<rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black" />
														</svg>
													</span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack flex-grow-1">
                                        <!--begin::Content-->
                                        <div class="fw-bold">
                                            <div class="fs-6 text-gray-700">If you having trouble using the QR code, select manual entry on your app, and enter your username and the code:
                                                <div class="fw-bolder text-dark pt-2">KBSS3QDAAFUMCBY63YCKI5WSSVACUMPN</div></div>
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Notice-->
                                <!--begin::Form-->
                                <form data-kt-element="apps-form" class="form" action="#">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <input type="text" class="form-control form-control-lg form-control-solid" placeholder="Enter authentication code" name="code" />
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex flex-center">
                                        <button type="reset" data-kt-element="apps-cancel" class="btn btn-light me-3">Cancel</button>
                                        <button type="submit" data-kt-element="apps-submit" class="btn btn-primary">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
															<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Options-->
                            <!--begin::SMS-->
                            <div class="d-none" data-kt-element="sms">
                                <!--begin::Heading-->
                                <h3 class="text-dark fw-bolder fs-3 mb-5">SMS: Verify Your Mobile Number</h3>
                                <!--end::Heading-->
                                <!--begin::Notice-->
                                <div class="text-muted fw-bold mb-10">Enter your mobile phone number with country code and we will send you a verification code upon request.</div>
                                <!--end::Notice-->
                                <!--begin::Form-->
                                <form data-kt-element="sms-form" class="form" action="#">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <input type="text" class="form-control form-control-lg form-control-solid" placeholder="Mobile number with country code..." name="mobile" />
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex flex-center">
                                        <button type="reset" data-kt-element="sms-cancel" class="btn btn-light me-3">Cancel</button>
                                        <button type="submit" data-kt-element="sms-submit" class="btn btn-primary">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
															<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::SMS-->
                        </div>
                        <!--begin::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal header-->
            </div>
            <!--end::Modal - Two-factor authentication-->
            <!--end::Modals-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Container-->


@endsection

@section('js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/dropzone.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <!-- END: Page Vendor JS-->
    <script src="{{ asset('assets/js/custom/account/settings/signin-methods.js') }}"></script>


@stop
