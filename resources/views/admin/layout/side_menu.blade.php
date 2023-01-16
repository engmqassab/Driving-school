<!--begin::Container-->
<div class="header-menu-container container-xxl d-flex flex-stack h-lg-75px" id="kt_header_nav">
    <!--begin::Menu wrapper-->
    <div class="header-menu flex-column flex-lg-row" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
        <!--begin::Menu-->
        <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch flex-grow-1" id="#kt_header_menu" data-kt-menu="true">
            <div data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                <a class="menu-link @if($menu == 'home') active @endif py-3" href="{{ route('admin.home') }}">
                    <span class="menu-title">{{ __('الصفحة الرئيسية') }}</span>
                    <span class="menu-arrow d-lg-none"></span>
                </a>
            </div>
            <div data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
										<a class="menu-link  @if($menu == 'users') active @endif  py-3" href="{{ route('admin.users.index') }}">
											<span class="menu-title">{{ __('المستخدمين') }}</span>
											<span class="menu-arrow d-lg-none"></span>
										</a>
            </div>
            <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item
            @if($menu == 'students' || $menu == 'trainers' || $menu ==  'application_cases' || $menu == 'transfer_types' || $menu == 'applications' || $menu == 'cities'|| $menu == 'drive_license') here @endif
            menu-lg-down-accordion me-lg-1">
										<span class="menu-link py-3">
											<span class="menu-title">{{ __('البيانات') }}</span>
											<span class="menu-arrow d-lg-none"></span>
										</span>
                <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">

                    <div data-kt-menu-placement="left-start" class="menu-item  menu-lg-down-accordion">
												<a class="menu-link @if($menu == 'students') active @endif py-3" href="{{ route('admin.students.index') }}">

                                                    <span class="menu-icon">
                                                        <i class="las la-user"></i>
                                                    </span>
													<span class="menu-title">{{ __('الطلاب') }}</span>
												</a>
                    </div>


                    <div data-kt-menu-placement="left-start" class="menu-item menu-lg-down-accordion">
												<a class="menu-link  @if($menu == 'trainers') active @endif py-3"  href="{{ route('admin.trainers.index') }}">
                                                    <span class="menu-icon">
                                                        <i class="las la-user-tie"></i>
                                                    </span>
													<span class="menu-title">{{ __('المدربين') }}</span>
												</a>
                    </div>
                    <div data-kt-menu-placement="left-start" class="menu-item  menu-lg-down-accordion">
                        <a class="menu-link @if($menu == 'cities') active @endif py-3" href="{{ route('admin.cities.index') }}">
                            <span class="menu-icon">
                                <i class="las la-car"></i>
                            </span>
                            <span class="menu-title">{{ __('المدن') }}</span>
                        </a>
                    </div>
                        <div data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="left-start" class="menu-item
                        @if($menu ==  'application_cases' || $menu == 'transfer_types' || $menu == 'applications'|| $menu == 'drive_license') here @endif
                        menu-lg-down-accordion">
												<span class="menu-link py-3">
													<span class="menu-icon">
                                                        <i class="las la-file-alt"></i>
													</span>
													<span class="menu-title">{{ __('الطلبات') }}</span>
													<span class="menu-arrow"></span>
												</span>
                            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg py-lg-4 w-lg-225px">
                                <div class="menu-item">
                                    <a class="menu-link @if($menu == 'applications') active @endif py-3" href="{{ route('admin.applications.index') }}">
															<span class="menu-bullet">
																<span class="bullet bullet-dot"></span>
															</span>
                                        <span class="menu-title">{{ __('الطلبات') }}</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link @if($menu == 'transfer_types') active @endif py-3" href="{{ route('admin.transfer-types.index') }}">
															<span class="menu-bullet">
																<span class="bullet bullet-dot"></span>
															</span>
                                        <span class="menu-title">{{ __('أنواع النقل') }}</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link @if($menu == 'application_cases') active @endif  py-3" href="{{ route('admin.application-cases.index') }}">
															<span class="menu-bullet">
																<span class="bullet bullet-dot"></span>
															</span>
                                        <span class="menu-title">{{ __('حالات الطلب') }}</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link @if($menu == 'drive_license') active @endif py-3" href="{{ route('admin.drive-licenses.index') }}">
															<span class="menu-bullet">
																<span class="bullet bullet-dot"></span>
															</span>
                                        <span class="menu-title">{{ __('تراخيص القيادة') }}</span>
                                    </a>
                                </div>


                            </div>
                        </div>
                </div>
            </div>
            <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item
            @if($menu == 'cars' || $menu == 'car_types' || $menu ==  'car_licenses' || $menu == 'car_insurances' ) here @endif
            menu-lg-down-accordion me-lg-1">
										<span class="menu-link py-3">
											<span class="menu-title">{{ __('المركبات') }}</span>
											<span class="menu-arrow d-lg-none"></span>
										</span>
                <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">

                    <div data-kt-menu-placement="left-start" class="menu-item  menu-lg-down-accordion">
                        <a class="menu-link @if($menu == 'cars') active @endif py-3" href="{{ route('admin.cars.index') }}">
                                                    <span class="menu-icon">
                                                        <i class="las la-car"></i>
                                                    </span>
                            <span class="menu-title">{{ __('المركبات') }}</span>
                        </a>
                    </div>
                    <div data-kt-menu-placement="left-start" class="menu-item  menu-lg-down-accordion">
                        <a class="menu-link @if($menu == 'car_types') active @endif py-3" href="{{ route('admin.car-types.index') }}">
                                                    <span class="menu-icon">
                                                        <i class="las la-file-invoice"></i>
                                                    </span>
                            <span class="menu-title">{{ __('أنواع المركبات') }}</span>
                        </a>
                    </div>
                    <div data-kt-menu-placement="left-start" class="menu-item  menu-lg-down-accordion">
                        <a class="menu-link @if($menu == 'car_licenses') active @endif py-3" href="{{ route('admin.car-licenses.index') }}">
                                                    <span class="menu-icon">
                                                        <i class="las la-address-card"></i>
                                                    </span>
                            <span class="menu-title">{{ __('أنواع التراخيص') }}</span>
                        </a>
                    </div>
                    <div data-kt-menu-placement="left-start" class="menu-item  menu-lg-down-accordion">
                        <a class="menu-link @if($menu == 'car_insurances') active @endif py-3" href="{{ route('admin.car-insurances.index') }}">
                                                    <span class="menu-icon">
																		<i class="las la-unlock"></i>
																	</span>
                            <span class="menu-title">{{ __('أنواع التأمين') }}</span>
                        </a>
                    </div>
                </div>
            </div>
            <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item
            @if($menu == 'check_types' || $menu == 'check_cases' || $menu ==  'check_results' ) here @endif
            menu-lg-down-accordion me-lg-1">
										<span class="menu-link py-3">
											<span class="menu-title">{{ __('الفحوصات') }}</span>
											<span class="menu-arrow d-lg-none"></span>
										</span>
                <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">

                    <div data-kt-menu-placement="left-start" class="menu-item  menu-lg-down-accordion">
                        <a class="menu-link @if($menu == 'check_types') active @endif py-3" href="{{ route('admin.check-types.index') }}">
                                                    <span class="menu-icon">
                                                        <i class="las la-list"></i>
                                                    </span>
                            <span class="menu-title">{{ __('أنواع الفحوصات') }}</span>
                        </a>
                    </div>
                    <div data-kt-menu-placement="left-start" class="menu-item  menu-lg-down-accordion">
                        <a class="menu-link @if($menu == 'check_cases') active @endif py-3" href="{{ route('admin.check-cases.index') }}">
                                                    <span class="menu-icon">
                                                        <i class="las la-list-ol"></i>
                                                    </span>
                            <span class="menu-title">{{ __('حالات الفحص') }}</span>
                        </a>
                    </div>
                    <div data-kt-menu-placement="left-start" class="menu-item  menu-lg-down-accordion">
                        <a class="menu-link @if($menu == 'check_results') active @endif py-3" href="{{ route('admin.check-results.index') }}">
                                                    <span class="menu-icon">
                                                        <i class="las la-list-alt"></i>
                                                    </span>
                            <span class="menu-title">{{ __('نتائج الفحص') }}</span>
                        </a>
                    </div>

                </div>
            </div>


        </div>
        <!--end::Menu-->

    </div>
    <!--end::Menu wrapper-->
</div>
<!--end::Container-->
