<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationCase;
use App\Models\CheckResult;
use App\Models\CheckType;
use App\Models\Citie;
use App\Models\DriveLicense;
use App\Models\Student;
use App\Models\TransferType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Application::where([
            'student_id' => null
        ])->delete();

        if ($request->ajax()) {
            $application = Application::all();

            return datatables()->of($application)
                ->addcolumn('actions', function (Application $application) {
                    $edit = '<a href="' . url('admin/applications/' . $application->id) . '/edit" class="btn btn-light-dark btn-icon btn-sm m-1 btn-flat-dark waves-effect" "title="تعديل " ><i class="la la-edit"></i></a>';

                    $delete = '<a href="javascript:void(0);" class="btn btn-light-danger btn-icon btn-sm m-1 btn-flat-dark waves-effect deleteRecord" data-bs-toggle= "modal" id= "' . $application->id . '" title="حذف "><i class="la la-trash"></i></a>';

                    $show = '<a href="javascript:void(0);" class="btn btn-light-primary btn-icon btn-sm m-1 btn-flat-dark waves-effect showRecord" data-bs-toggle= "modal" data-id= "' . $application->id . '" title="عرض "><i class="la la-eye"></i></a>';

                    return $edit . $delete . $show;
                })
                ->addColumn('name', function ($model) {
                    $name = $model->students->first_name . ' ' . $model->students->second_name . ' ' . $model->students->third_name . ' ' . $model->students->last_name;
                    return $name;
                })
                ->addColumn('case', function ($model) {
                    if (!empty($model->cases))
                        return $model->cases->name;

                    return "لا يوجد";
                })
                ->rawColumns(['actions', 'name', 'case'])
                ->addIndexColumn()
                ->make(true);
        }
        $application = Application::all();

        return view('admin.applications.index', [
            'application' => $application,
            'menu' => 'applications',
            'location_title' => 'الطلبات',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $student = new Student();
        if(!empty(Application::latest()->first()))
            $app_id = Application::latest()->first()->id + 1;
        else
            $app_id = 1;

        $app = new Application();

        $cities = Citie::all();
        $application_cases = ApplicationCase::all();
        $students = Student::all();
        $drive_license = DriveLicense::all();
        $check_type = CheckType::all();
        $check_result = CheckResult::all();
        $transfer_type = TransferType::all();

        $old_student = session::get('old_student');
        Session::forget('old_student');
        $transfer = session::get('transfer');
        Session::forget('transfer');

        return view('admin.applications.create', [
            'student' => $student,
            'app' => $app,
            'app_id' => $app_id,
            'transfer' => $transfer,
            'students' => $students,
            'old_student' =>$old_student,
            'cities' => $cities,
            'application_cases' => $application_cases,
            'drive_license' => $drive_license,
            'check_type' => $check_type,
            'check_result' => $check_result,
            'transfer_type' => $transfer_type,
            'menu' => 'applications',
            'location_title' => 'الطلبات',
            'sub_title' => 'أضافة طلب',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->old_student != 'old'){
            DB::beginTransaction();
            try {
                Session::put('old_student',1);

                $student = Student::create($request->all());

                if ($request->transfer_type_id == "لا يوجد") {
                    Session::put('transfer',2);
                    $request->validate([
                        'card_id' => ['required', 'numeric'],
                        'first_name' => ['required', 'string', 'max:255'],
                        'second_name' => ['required', 'string', 'max:255'],
                        'third_name' => ['required', 'string', 'max:255'],
                        'last_name' => ['required', 'string', 'max:255'],
                        'mobile' => ['required', 'numeric', 'max:255'],
                        'gender' => ['required'],
                        'birth_date' => ['required', 'string'],
                        'city_id' => ['required'],
                        'town' => ['required', 'string', 'max:255'],
                        'address' => ['required', 'string', 'max:255'],
                        'application_date' => ['required'],
                        'arr_type' => ['required'],
                        'theoretical_price' => ['required'],
                        'practical_price' => ['required'],
                        'application_case_id' => ['required'],
                        'drive_license_id' => ['required'],
                        'transfer_type_id' => ['required'],
                        'check_date' => ['required'],
                        'check_type_id' => ['required'],
                        'check_result_id' => ['required'],

                    ], [
                        'card_id.required' => 'رقم البطاقة مطلوب',
                        'card_id.numeric' => 'رقم البطاقة يجب ان يكون رقم',

                        'first_name.required' => 'الاسم الاول مطلوب',
                        'first_name.string' => 'الاسم الاول يجب ان يكون نص',
                        'first_name.max' => 'الاسم الاول يجب ان لا يزيد عن 255 حرف',

                        'second_name.required' => 'الاسم التاني مطلوب',
                        'second_name.string' => 'الاسم التاني يجب ان يكون نص',
                        'second_name.max' => 'الاسم التاني يجب ان لا يزيد عن 255 حرف',

                        'third_name.required' => 'الاسم الثالث مطلوب',
                        'third_name.string' => 'الاسم الثالث يجب ان يكون نص',
                        'third_name.max' => 'الاسم الثالث يجب ان لا يزيد عن 255 حرف',

                        'last_name.required' => 'الاسم الاخير مطلوب',
                        'last_name.string' => 'الاسم الاخير يجب ان يكون نص',
                        'last_name.max' => 'الاسم الاخير يجب ان لا يزيد عن 255 حرف',

                        'mobile.required' => 'رقم الموبايل مطلوب',
                        'mobile.numeric' => 'رقم الموبايل يجب ان يكون رقم',
                        'mobile.max' => 'رقم الموبايل يجب ان لا يزيد عن 255 حرف',

                        'gender.required' => 'الجنس مطلوب',

                        'birth_date.required' => 'تاريخ الميلاد مطلوب',
                        'birth_date.string' => 'تاريخ الميلاد يجب ان يكون نص',

                        'town.required' => 'الحي مطلوب',
                        'town.string' => 'الحي يجب ان يكون نص',
                        'town.max' => 'الحي يجب ان لا يزيد عن 255 حرف',

                        'city_id.required' => 'المدينة مطلوب',

                        'address.required' => 'العنوان مطلوب',
                        'address.string' => 'العنوان يجب ان يكون نص',
                        'address.max' => 'العنوان يجب ان لا يزيد عن 255 حرف',

                        'application_date.required' => 'تاريخ الطلب مطلوب',
                        'arr_type.required' => 'نوع الاتفاق مطلوب',
                        'theoretical_price.required' => 'سعر النظري مطلوب',
                        'practical_price.required' => 'سعر العملي مطلوب',
                        'application_case_id.required' => 'حالة الطلب مطلوب',
                        'drive_license_id.required' => 'نوع الرخصة مطلوب',
                        'transfer_type_id.required' => 'عمليه النقل مطلوب',
                        'check_date.required' => 'تاريخ الفحص مطلوب',
                        'check_type_id.required' => 'نوع الفحص مطلوب',
                        'check_result_id.required' => 'نتيجة الفحص مطلوب',

                    ]);
                    $data = $request->except('transfer_from', 'transfer_date', 'transfer_type_id');
                    $data['student_id'] =  $student->id;
                    $app = Application::create($data);
                } else {
                    Session::put('transfer',1);
                    $request->validate([
                        'card_id' => ['required', 'numeric'],
                        'first_name' => ['required', 'string', 'max:255'],
                        'second_name' => ['required', 'string', 'max:255'],
                        'third_name' => ['required', 'string', 'max:255'],
                        'last_name' => ['required', 'string', 'max:255'],
                        'mobile' => ['required', 'numeric', 'max:255'],
                        'gender' => ['required'],
                        'birth_date' => ['required', 'string'],
                        'city_id' => ['required'],
                        'town' => ['required', 'string', 'max:255'],
                        'address' => ['required', 'string', 'max:255'],
                        'application_date' => ['required'],
                        'arr_type' => ['required'],
                        'theoretical_price' => ['required'],
                        'practical_price' => ['required'],
                        'application_case_id' => ['required'],
                        'drive_license_id' => ['required'],
                        'transfer_type_id' => ['required'],
                        'check_date' => ['required'],
                        'check_type_id' => ['required'],
                        'check_result_id' => ['required'],
                        'transfer_from' => ['required'],
                        'transfer_date' => ['required'],
                    ], [
                        'card_id.required' => 'رقم البطاقة مطلوب',
                        'card_id.numeric' => 'رقم البطاقة يجب ان يكون رقم',

                        'first_name.required' => 'الاسم الاول مطلوب',
                        'first_name.string' => 'الاسم الاول يجب ان يكون نص',
                        'first_name.max' => 'الاسم الاول يجب ان لا يزيد عن 255 حرف',

                        'second_name.required' => 'الاسم التاني مطلوب',
                        'second_name.string' => 'الاسم التاني يجب ان يكون نص',
                        'second_name.max' => 'الاسم التاني يجب ان لا يزيد عن 255 حرف',

                        'third_name.required' => 'الاسم الثالث مطلوب',
                        'third_name.string' => 'الاسم الثالث يجب ان يكون نص',
                        'third_name.max' => 'الاسم الثالث يجب ان لا يزيد عن 255 حرف',

                        'last_name.required' => 'الاسم الاخير مطلوب',
                        'last_name.string' => 'الاسم الاخير يجب ان يكون نص',
                        'last_name.max' => 'الاسم الاخير يجب ان لا يزيد عن 255 حرف',

                        'mobile.required' => 'رقم الموبايل مطلوب',
                        'mobile.numeric' => 'رقم الموبايل يجب ان يكون رقم',
                        'mobile.max' => 'رقم الموبايل يجب ان لا يزيد عن 255 حرف',

                        'gender.required' => 'الجنس مطلوب',
                        'city_id.required' => 'المدينة مطلوب',

                        'birth_date.required' => 'تاريخ الميلاد مطلوب',
                        'birth_date.string' => 'تاريخ الميلاد يجب ان يكون نص',

                        'town.required' => 'الحي مطلوب',
                        'town.string' => 'الحي يجب ان يكون نص',
                        'town.max' => 'الحي يجب ان لا يزيد عن 255 حرف',

                        'address.required' => 'العنوان مطلوب',
                        'address.string' => 'العنوان يجب ان يكون نص',
                        'address.max' => 'العنوان يجب ان لا يزيد عن 255 حرف',

                        'application_date.required' => 'تاريخ الطلب مطلوب',
                        'arr_type.required' => 'نوع الاتفاق مطلوب',
                        'theoretical_price.required' => 'سعر النظري مطلوب',
                        'practical_price.required' => 'سعر العملي مطلوب',
                        'application_case_id.required' => 'حالة الطلب مطلوب',
                        'drive_license_id.required' => 'نوع الرخصة مطلوب',
                        'transfer_type_id.required' => 'عمليه النقل مطلوب',
                        'check_date.required' => 'تاريخ الفحص مطلوب',
                        'check_type_id.required' => 'نوع الفحص مطلوب',
                        'check_result_id.required' => 'نتيجة الفحص مطلوب',
                        'transfer_from.required' => 'اسم المدرسة مطلوب',
                        'transfer_date.required' => 'تاريخ النقل مطلوب',
                    ]);

                    $data = $request->all();
                    $data['student_id'] =  $student->id;
                    $app = Application::create($data);
                }

                Session::forget('old_student');
                Session::forget('transfer');
                DB::commit();
                toastr()->success('تم العملية بنجاح');

                return redirect()->route('admin.applications.index');


            }
            catch (Throwable $e) {
                toastr()->error('يرجى التاكد من ادخال البيانات كاملة');
                return redirect()->route('admin.applications.index');

            }
        }
        else{
            DB::beginTransaction();
            try {

                Session::put('old_student',2);

                if ($request->transfer_type_id == "لا يوجد") {
                    Session::put('transfer',2);
                    $request->validate([
                        'student_id' => ['required'],
                        'application_date' => ['required'],
                        'arr_type' => ['required'],
                        'theoretical_price' => ['required'],
                        'practical_price' => ['required'],
                        'application_case_id' => ['required'],
                        'drive_license_id' => ['required'],
                        'transfer_type_id' => ['required'],
                        'check_date' => ['required'],
                        'check_type_id' => ['required'],
                        'check_result_id' => ['required'],

                    ], [
                        'student_id.required' => 'الطالب مطلوب',
                        'application_date.required' => 'تاريخ الطلب مطلوب',
                        'arr_type.required' => 'نوع الاتفاق مطلوب',
                        'theoretical_price.required' => 'سعر النظري مطلوب',
                        'practical_price.required' => 'سعر العملي مطلوب',
                        'application_case_id.required' => 'حالة الطلب مطلوب',
                        'drive_license_id.required' => 'نوع الرخصة مطلوب',
                        'transfer_type_id.required' => 'عمليه النقل مطلوب',
                        'check_date.required' => 'تاريخ الفحص مطلوب',
                        'check_type_id.required' => 'نوع الفحص مطلوب',
                        'check_result_id.required' => 'نتيجة الفحص مطلوب',

                    ]);
                    $data = $request->except('transfer_from', 'transfer_date', 'transfer_type_id');
                    $app = Application::create($data);
                } else {
                    Session::put('transfer',1);
                    $request->validate([
                        'student_id' => ['required'],
                        'application_date' => ['required'],
                        'arr_type' => ['required'],
                        'theoretical_price' => ['required'],
                        'practical_price' => ['required'],
                        'application_case_id' => ['required'],
                        'drive_license_id' => ['required'],
                        'transfer_type_id' => ['required'],
                        'check_date' => ['required'],
                        'check_type_id' => ['required'],
                        'check_result_id' => ['required'],
                        'transfer_from' => ['required'],
                        'transfer_date' => ['required'],
                    ], [
                        'student_id.required' => 'الطالب مطلوب',
                        'application_date.required' => 'تاريخ الطلب مطلوب',
                        'arr_type.required' => 'نوع الاتفاق مطلوب',
                        'theoretical_price.required' => 'سعر النظري مطلوب',
                        'practical_price.required' => 'سعر العملي مطلوب',
                        'application_case_id.required' => 'حالة الطلب مطلوب',
                        'drive_license_id.required' => 'نوع الرخصة مطلوب',
                        'transfer_type_id.required' => 'عمليه النقل مطلوب',
                        'check_date.required' => 'تاريخ الفحص مطلوب',
                        'check_type_id.required' => 'نوع الفحص مطلوب',
                        'check_result_id.required' => 'نتيجة الفحص مطلوب',
                        'transfer_from.required' => 'اسم المدرسة مطلوب',
                        'transfer_date.required' => 'تاريخ النقل مطلوب',

                    ]);

                    $data = $request->all();
                    $app = Application::create($data);
                }

                Session::forget('old_student');
                Session::forget('transfer');
                DB::commit();
                toastr()->success('تم العملية بنجاح');

                return redirect()->route('admin.applications.index');


            }
            catch (Throwable $e) {
                toastr()->error('يرجى التاكد من ادخال البيانات كاملة');
                return redirect()->route('admin.applications.index');

            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Application::findOrFail($id);
        $data['name'] = $data->students->getFullname();
        $data['card_id'] = $data->students->card_id;
        $data['mobile'] = $data->students->mobile;
        $data['gender'] = $data->students->gender;
        $data['birth_date'] = $data->students->birth_date;
        $data['city'] = $data->students->cities->name;
        $data['town'] = $data->students->town;
        $data['address'] = $data->students->address;
        $data['case'] = $data->cases->name;
        $data['license'] = $data->licenses->name;
        $data['check_type'] = $data->check_types->name;
        $data['check_result'] = $data->check_results->name;
        $data['license'] = $data->licenses->name;
        $data['transfer_type'] = $data->transfer_types->name ?? 'لا يوجد';
        $data['transfer_date'] = $data->transfer_date ?? 'لا يوجد';
        $data['transfer_from'] = $data->transfer_from ?? 'لا يوجد';


        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $app = Application::findorFail($id);
        $student = Student::findorFail($app->student_id);
        $students = Student::all();

        $cities = Citie::all();
        $application_cases = ApplicationCase::all();
        $drive_license = DriveLicense::all();
        $check_type = CheckType::all();
        $check_result = CheckResult::all();
        $transfer_type = TransferType::all();

        $old_student = session::get('old_student');
        Session::forget('old_student');
        $transfer = session::get('transfer');
        Session::forget('transfer');
        return view('admin.applications.edit', [
            'students' =>$students,
            'transfer' => $transfer,
            'old_student' => $old_student,
            'student' => $student,
            'student_id' => $app->student_id,
            'app' => $app,
            'app_id' => $id,
            'cities' => $cities,
            'application_cases' => $application_cases,
            'drive_license' => $drive_license,
            'check_type' => $check_type,
            'check_result' => $check_result,
            'transfer_type' => $transfer_type,
            'menu' => 'applications',
            'location_title' => 'الطلبات',
            'sub_title' => 'تعديل طلب',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $application = Application::findorFail($id);

        DB::beginTransaction();
        try {

            Session::put('old_student',2);
            if ($request->transfer_type_id == "لا يوجد") {
                Session::put('transfer',2);
                $request->validate([
                    'student_id' => ['required'],
                    'application_date' => ['required'],
                    'arr_type' => ['required'],
                    'theoretical_price' => ['required'],
                    'practical_price' => ['required'],
                    'application_case_id' => ['required'],
                    'drive_license_id' => ['required'],
                    'transfer_type_id' => ['required'],
                    'check_date' => ['required'],
                    'check_type_id' => ['required'],
                    'check_result_id' => ['required'],

                ], [
                    'student_id.required' => 'الطالب مطلوب',
                    'application_date.required' => 'تاريخ الطلب مطلوب',
                    'arr_type.required' => 'نوع الاتفاق مطلوب',
                    'theoretical_price.required' => 'سعر النظري مطلوب',
                    'practical_price.required' => 'سعر العملي مطلوب',
                    'application_case_id.required' => 'حالة الطلب مطلوب',
                    'drive_license_id.required' => 'نوع الرخصة مطلوب',
                    'transfer_type_id.required' => 'عمليه النقل مطلوب',
                    'check_date.required' => 'تاريخ الفحص مطلوب',
                    'check_type_id.required' => 'نوع الفحص مطلوب',
                    'check_result_id.required' => 'نتيجة الفحص مطلوب',

                ]);

                $data = $request->except('transfer_from', 'transfer_date', 'transfer_type_id');
                $data['transfer_type_id'] = null;
                $data['transfer_from'] = null;
                $data['transfer_date'] = null;
                $application->update($data);

            } else {
                Session::put('transfer',1);
                $request->validate([
                    'student_id' => ['required'],
                    'application_date' => ['required'],
                    'arr_type' => ['required'],
                    'theoretical_price' => ['required'],
                    'practical_price' => ['required'],
                    'application_case_id' => ['required'],
                    'drive_license_id' => ['required'],
                    'transfer_type_id' => ['required'],
                    'check_date' => ['required'],
                    'check_type_id' => ['required'],
                    'check_result_id' => ['required'],
                    'transfer_from' => ['required'],
                    'transfer_date' => ['required'],
                ], [
                    'student_id.required' => 'الطالب مطلوب',
                    'application_date.required' => 'تاريخ الطلب مطلوب',
                    'arr_type.required' => 'نوع الاتفاق مطلوب',
                    'theoretical_price.required' => 'سعر النظري مطلوب',
                    'practical_price.required' => 'سعر العملي مطلوب',
                    'application_case_id.required' => 'حالة الطلب مطلوب',
                    'drive_license_id.required' => 'نوع الرخصة مطلوب',
                    'transfer_type_id.required' => 'عمليه النقل مطلوب',
                    'check_date.required' => 'تاريخ الفحص مطلوب',
                    'check_type_id.required' => 'نوع الفحص مطلوب',
                    'check_result_id.required' => 'نتيجة الفحص مطلوب',
                    'transfer_from.required' => 'اسم المدرسة مطلوب',
                    'transfer_date.required' => 'تاريخ النقل مطلوب',

                ]);

                $data = $request->all();
                $application->update($data);
            }

            Session::forget('old_student');
            Session::forget('transfer');
            DB::commit();
            toastr()->success('تم العملية بنجاح');

            return redirect()->route('admin.applications.index');


        }
        catch (Throwable $e) {
            toastr()->error('يرجى التاكد من ادخال البيانات كاملة');
            return redirect()->route('admin.applications.index');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $application = Application::findorFail($id);
        $application->delete();

    }


    public function destroyAll(Request $request)
    {
        $application_id_array = $request->input('id');
        $application = Application::whereIn('id', $application_id_array);
        $application->delete();

    }

}
