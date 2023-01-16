<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarInsurance;
use App\Models\CarLicense;
use App\Models\CarType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class   CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $car = Car::all();

            return datatables()->of($car)
                ->addcolumn('actions', function (Car $car) {
                    $edit = '<a href="javascript:void(0);"  class="btn btn-light-dark btn-icon btn-sm m-1 btn-flat-dark waves-effect editRecord" data-bs-toggle= "modal" data-id= "' . $car->id . '" title="تعديل "><i class="la la-edit"></i></a>';

                    $delete = '<a href="javascript:void(0);" class="btn btn-light-danger btn-icon btn-sm m-1 btn-flat-dark waves-effect deleteRecord" data-bs-toggle= "modal" id= "' . $car->id . '" title="حذف "><i class="la la-trash"></i></a>';

                    return $edit . $delete;
                })
                ->addColumn('type', function ($model) {
                    if(!empty($model->types))
                        return $model->types->name;

                    return "لا يوجد";
                })
                ->addColumn('license', function ($model) {
                    if(!empty($model->licenses))
                        return $model->licenses->name;

                    return "لا يوجد";
                })
                ->addColumn('insurance', function ($model) {
                    if(!empty($model->insurances))
                        return $model->insurances->name;

                    return "لا يوجد";
                })
                ->rawColumns(['actions','type','license','insurance'])
                ->addIndexColumn()
                ->make(true);
        }
        $car = Car::all();

        return view('admin.cars.index', [
            'cars' => $car,
            'car_types' => CarType::all(),
            'car_licenses' => CarLicense::all(),
            'car_insurances' => CarInsurance::all(),
            'menu' => 'cars',
            'location_title' => 'المركبات',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'car_number' => ['required', 'numeric'],
            'type_id' => ['required'],
            'license_id' => ['required'],
            'insurance_id' => ['required'],
            'year' => ['required', 'max:255'],
        ], [
            'car_number.required' => 'رقم السيارة مطلوب',
            'car_number.numeric' => 'رقم البطاقة يجب ان يكون رقم',

            'type_id.required' => 'النوع مطلوب',

            'license_id.required' => 'الترخيص مطلوب',

            'insurance_id.required' => ' التأمين مطلوب',

            'last_name.required' => 'الاسم الاخير مطلوب',

            'year.required' => 'سنة الصنع مطلوب',
        ]);

        $car = Car::create($request->all());
        if (!empty($car)) {
            return response()->json([
                'success' => true,
                'car_id' => $car->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'car_id' => $car->id,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Car::findOrFail($id);
        $data['type'] = $data->types->name;
        $data['license'] = $data->licenses->name;
        $data['insurance'] = $data->insurances->name;

        return $data;

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
        $request->validate([
            'car_number' => ['required', 'numeric'],
            'type_id' => ['required'],
            'license_id' => ['required'],
            'insurance_id' => ['required'],
            'year' => ['required', 'max:255'],
        ], [
            'car_number.required' => 'رقم السيارة مطلوب',
            'car_number.numeric' => 'رقم البطاقة يجب ان يكون رقم',

            'type_id.required' => 'النوع مطلوب',

            'license_id.required' => 'الترخيص مطلوب',

            'insurance_id.required' => ' التأمين مطلوب',

            'last_name.required' => 'الاسم الاخير مطلوب',

            'year.required' => 'سنة الصنع مطلوب',
        ]);

        $car = Car::findorFail($id);
        $car->update($request->all());
        if (!empty($car)) {
            return response()->json([
                'success' => true,
                'car_id' => $car->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'car_id' => $car->id,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::findorFail($id);
        $car->delete();

    }
    public function destroyAll(Request $request)
    {
        $car_id_array = $request->input('id');
        $car = Car::whereIn('id', $car_id_array);
        $car->delete();

    }
}

