@extends('layouts.app')

@section('content')
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-up -->
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14.png">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Logo-->
                <a href="#" class="mb-12">
                    <img alt="Logo" src="assets/media/logos/logo-2.svg" class="h-40px" />
                </a>
                <!--end::Logo-->
                <!--begin::Wrapper-->
                <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    <x-alert/>
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form"action="{{ route('register') }}" method="POST">
                        @csrf
                        <!--begin::Heading-->
                        <div class="mb-10 text-center">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">{{__('انشاء حساب')}}</h1>
                            <!--end::Title-->
                            <!--begin::Link-->
                            <div class="text-gray-400 fw-bold fs-4">{{__('لديك حساب بالفعل؟')}}
                                <a  href="{{ route('login') }}" class="link-primary fw-bolder">{{__('سجل دخول')}}</a></div>
                            <!--end::Link-->
                        </div>
                        <!--end::Heading-->

                        <!--begin::Input group-->
                        <div class="row fv-row mb-7">
                            <!--begin::Col-->
                            <div class="fv-row mb-2">
                                <!--begin::Label-->
                                <label class="form-label fs-6 fw-bolder text-dark">{{__('الاسم')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-lg form-control-solid  @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" autocomplete="off" />
                                <!--end::Input-->
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!--end::Col-->

                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row fv-row mb-7">
                            <!--begin::Col-->
                            <div class="fv-row mb-2">
                                <!--begin::Label-->
                                <label class="form-label fs-6 fw-bolder text-dark">{{__('أسم المستخدم')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-lg form-control-solid  @error('username') is-invalid @enderror" type="text" name="username" value="{{ old('username') }}" autocomplete="off" />
                                <!--end::Input-->
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!--end::Col-->

                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6">{{__('الايميل')}}</label>
                            <input class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" type="email" placeholder=""value="{{ old('email') }}" name="email" autocomplete="off" />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack mb-2">
                                <!--begin::Label-->
                                <label class="form-label fw-bolder text-dark fs-6 mb-0">{{__('كلمة المرور')}}</label>
                                <!--end::Label-->

                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid  @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="off" />
                            <!--end::Input-->
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack mb-2">
                                <!--begin::Label-->
                                <label class="form-label fw-bolder text-dark fs-6 mb-0">{{__('تأكيد كلمة المرور')}}</label>
                                <!--end::Label-->

                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid  @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" required autocomplete="off" />
                            <!--end::Input-->
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                            @enderror
                        </div>

                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
                                <span class="indicator-label">{{__('أنشاء حساب')}}</span>
                                <span class="indicator-progress">{{__('الرجاء الانتظار...')}}
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Authentication - Sign-up-->
    </div>
    <!--end::Main-->

@endsection
