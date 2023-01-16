<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Citie;
use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Student::where([
            'first_name' => null
        ])->delete();

        if ($request->ajax()) {
            $student = Student::all();

            return datatables()->of($student)
                ->addcolumn('actions', function (Student $student) {
                    $edit = '<a href="' . url('admin/students/' . $student->id) . '/edit" class="btn btn-light-dark btn-icon btn-sm m-1 btn-flat-dark waves-effect" title="تعديل" ><i class="la la-edit"></i></a>';

                    $delete = '<a href="javascript:void(0);" class="btn btn-light-danger btn-icon btn-sm m-1 btn-flat-dark waves-effect deleteRecord" data-bs-toggle= "modal" id= "' . $student->id . '" title="حذف "><i class="la la-trash"></i></a>';

                    $show = '<a href="javascript:void(0);" class="btn btn-light-primary btn-icon btn-sm m-1 btn-flat-dark waves-effect showRecord" data-bs-toggle= "modal" data-id= "' . $student->id . '" title="عرض "><i class="la la-eye"></i></a>';

                    $pdf = '<a href="' . route('admin.student-pdf', $student->id) . '" class="btn btn-light-info btn-icon btn-sm m-1 btn-flat-dark waves-effect" title="PDF"><i class="la la-file-pdf-o"></i></a>';
                    return $edit . $delete . $show . $pdf;
                })
                ->addColumn('name', function ($model) {
                    $name = $model->first_name . ' ' . $model->second_name . ' ' . $model->third_name . ' ' . $model->last_name;
                    return $name;
                })
                ->addColumn('city', function ($model) {
                    if (!empty($model->cities))
                        return $model->cities->name;

                    return "لا يوجد";
                })
                ->rawColumns(['actions', 'city', 'name'])
                ->addIndexColumn()
                ->make(true);
        }
        $student = Student::all();

        return view('admin.students.index', [
            'student' => $student,
            'menu' => 'students',
            'location_title' => 'الطلاب',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.students.create', [
            'item' => new Student(),
            'cities' => Citie::all(),
            'menu' => 'students',
            'location_title' => 'الطلاب',
            'sub_title' => 'أضافة طالب',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'card_id' => ['required', 'numeric'],
            'first_name' => ['required', 'string', 'max:255'],
            'second_name' => ['required', 'string', 'max:255'],
            'third_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'birth_date' => ['required'],
            'city_id' => ['required'],
            'town' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
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

            'address.required' => 'العنوان مطلوب',
            'address.string' => 'العنوان يجب ان يكون نص',
            'address.max' => 'العنوان يجب ان لا يزيد عن 255 حرف',
        ]);

        Student::create($request->all());
        toastr()->success('تم العملية بنجاح');

        return redirect()->route('admin.students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Student::findOrFail($id);
        $data['name'] = $data->first_name.' '.$data->second_name .' '.$data->third_name .' '.$data->last_name;
        $data['city'] = $data->cities->name;


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
        $item = Student::findOrFail($id);
        return view('admin.students.edit', [
            'item' => $item,
            'cities' => Citie::all(),
            'menu' => 'students',
            'location_title' => 'الطلاب',
            'sub_title' => 'تعديل طالب',
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
        $student = Student::findorFail($id);
        $request->validate([
            'card_id' => ['required', 'numeric '],
            'first_name' => ['required', 'string', 'max:255'],
            'second_name' => ['required', 'string', 'max:255'],
            'third_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'birth_date' => ['required'],
            'city_id' => ['required'],
            'town' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
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

            'address.required' => 'العنوان مطلوب',
            'address.string' => 'العنوان يجب ان يكون نص',
            'address.max' => 'العنوان يجب ان لا يزيد عن 255 حرف',
        ]);


        $student->update($request->all());
        toastr()->success('تم العملية بنجاح');

        return redirect()->route('admin.students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findorFail($id);
        $student->delete();

    }


    public function destroyAll(Request $request)
    {
        $student_id_array = $request->input('id');
        $student = Student::whereIn('id', $student_id_array);
        $student->delete();

    }


    public function create_pdf($id)
    {

        $student = Student::findOrFail($id);
        $data = [
            'student' => $student
        ];

        $pdf = SnappyPdf::loadView('admin.students.pdf', $data);
        return $pdf->download('student.pdf');
    }
}
