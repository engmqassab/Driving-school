<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use Illuminate\Http\Request;

class TrainersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $trainer = Trainer::all();

            return datatables()->of($trainer)
                ->addcolumn('actions', function (Trainer $trainer) {
                    $edit = '<a href="' . url('admin/trainers/' . $trainer->id) . '/edit" class="btn btn-light-dark btn-icon btn-sm m-1 btn-flat-dark waves-effect" title="تعديل "><i class="la la-edit"></i></a>';

                    $delete = '<a href="javascript:void(0);" class="btn btn-light-danger btn-icon btn-sm m-1 btn-flat-dark waves-effect deleteRecord" data-bs-toggle= "modal" id= "' . $trainer->id . '" title="حذف "><i class="la la-trash"></i></a>';

                    $show = '<a href="javascript:void(0);" class="btn btn-light-primary btn-icon btn-sm m-1 btn-flat-dark waves-effect showRecord" data-bs-toggle= "modal" data-id= "' . $trainer->id . '" title="عرض "><i class="la la-eye"></i></a>';
                    return $edit . $delete . $show;
                })
                ->addColumn('name', function ($model) {
                    $name = $model->first_name.' '.$model->second_name .' '.$model->third_name .' '.$model->last_name;
                    return $name;
                })
                ->rawColumns(['actions','name'])
                ->addIndexColumn()
                ->make(true);
        }
        $trainer = Trainer::all();

        return view('admin.trainers.index', [
            'trainer' => $trainer,
            'menu' => 'trainers',
            'location_title' => 'المدربين',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trainers.create', [
            'item' => new Trainer(),
            'menu' => 'trainers',
            'location_title' => 'المدربين',
            'sub_title' => 'أضافة مدرب'
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
            'mobile' => ['required', 'numeric', 'max:255'],
            'phone' => ['required', 'numeric', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'driving_license_number' => ['required', 'numeric'],
            'driving_class' => ['required', 'numeric'],
            'driving_license_end_date' => ['required'],
            'training_license_number' => ['required', 'numeric'],
            'training_class' => ['required', 'numeric'],
            'training_license_end_date' => ['required'],

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

            'mobile.required' => 'رقم الهاتف مطلوب',
            'mobile.numeric' => 'رقم الهاتف يجب ان يكون رقم',
            'mobile.max' => 'رقم الهاتف يجب ان لا يزيد عن 255 حرف',

            'phone.required' => 'رقم الموبايل مطلوب',
            'phone.numeric' => 'رقم الموبايل يجب ان يكون رقم',
            'phone.max' => 'رقم الموبايل يجب ان لا يزيد عن 255 حرف',

            'address.required' => 'العنوان مطلوب',
            'address.string' => 'العنوان يجب ان يكون نص',
            'address.max' => 'العنوان يجب ان لا يزيد عن 255 حرف',

            'driving_license_number.required' => 'رقم الرخصه القيادة مطلوب',
            'driving_license_number.numeric' => 'رقم الرخصه القيادة يجب ان يكون رقم',

            'driving_class.required' => 'الدرجة مطلوب',
            'driving_class.numeric' => 'الدرجة يجب ان يكون رقم',

            'driving_license_end_date.required' => 'تاريخ الأنتهاء مطلوب',

            'training_license_number.required' => 'رقم الرخصه التدريب مطلوب',
            'training_license_number.numeric' => 'رقم الرخصه التدريب يجب ان يكون رقم',

            'training_class.required' => 'الدرجة مطلوب',
            'training_class.numeric' => 'الدرجة يجب ان يكون رقم',

            'training_license_end_date.required' => 'تاريخ الأنتهاء مطلوب',

        ]);

        Trainer::create($request->all());
        toastr()->success('تم العملية بنجاح');

        return redirect()->route('admin.trainers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Trainer::findOrFail($id);
        $data['name'] = $data->first_name.' '.$data->second_name .' '.$data->third_name .' '.$data->last_name;

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
        $item = Trainer::findOrFail($id);
        return view('admin.trainers.edit', [
            'item' => $item,
            'menu' => 'trainers',
            'location_title' => 'المدربين',
            'sub_title' => 'تعديل مدرب'
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
        $trainer = Trainer::findorFail($id);
        $request->validate([
            'card_id' => ['required', 'numeric'],
            'first_name' => ['required', 'string', 'max:255'],
            'second_name' => ['required', 'string', 'max:255'],
            'third_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'driving_license_number' => ['required', 'numeric'],
            'driving_class' => ['required', 'numeric'],
            'driving_license_end_date' => ['required'],
            'training_license_number' => ['required', 'numeric'],
            'training_class' => ['required', 'numeric'],
            'training_license_end_date' => ['required'],

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

            'mobile.required' => 'رقم الهاتف مطلوب',
            'mobile.numeric' => 'رقم الهاتف يجب ان يكون رقم',
            'mobile.max' => 'رقم الهاتف يجب ان لا يزيد عن 255 حرف',

            'phone.required' => 'رقم الموبايل مطلوب',
            'phone.numeric' => 'رقم الموبايل يجب ان يكون رقم',
            'phone.max' => 'رقم الموبايل يجب ان لا يزيد عن 255 حرف',

            'address.required' => 'العنوان مطلوب',
            'address.string' => 'العنوان يجب ان يكون نص',
            'address.max' => 'العنوان يجب ان لا يزيد عن 255 حرف',

            'driving_license_number.required' => 'رقم الرخصه القيادة مطلوب',
            'driving_license_number.numeric' => 'رقم الرخصه القيادة يجب ان يكون رقم',

            'driving_class.required' => 'الدرجة مطلوب',
            'driving_class.numeric' => 'الدرجة يجب ان يكون رقم',

            'driving_license_end_date.required' => 'تاريخ الأنتهاء مطلوب',

            'training_license_number.required' => 'رقم الرخصه التدريب مطلوب',
            'training_license_number.numeric' => 'رقم الرخصه التدريب يجب ان يكون رقم',

            'training_class.required' => 'الدرجة مطلوب',
            'training_class.numeric' => 'الدرجة يجب ان يكون رقم',

            'training_license_end_date.required' => 'تاريخ الأنتهاء مطلوب',

        ]);


        $trainer->update($request->all());
        toastr()->success('تم العملية بنجاح');

        return redirect()->route('admin.trainers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trainer = Trainer::findorFail($id);
        $trainer->delete();

    }
    public function destroyAll(Request $request)
    {
        $trainer_id_array = $request->input('id');
        $trainer = Trainer::whereIn('id', $trainer_id_array);
        $trainer->delete();

    }
}
