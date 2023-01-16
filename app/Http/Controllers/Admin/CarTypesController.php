<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarType;
use Illuminate\Http\Request;

class CarTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $car_types = CarType::all();

            return datatables()->of($car_types)
                ->addcolumn('actions', function (CarType $carType) {
                    $edit = '<a href="javascript:void(0);" class="btn btn-light-dark btn-icon btn-sm m-1 btn-flat-dark waves-effect editRecord" data-bs-toggle= "modal" data-id= "' . $carType->id . '" title="تعديل "><i class="la la-edit"></i></a>';

                    $delete = '<a href="javascript:void(0);" class="btn btn-light-danger btn-icon btn-sm m-1 btn-flat-dark waves-effect deleteRecord" data-bs-toggle= "modal" id= "' . $carType->id . '" title="حذف "><i class="la la-trash"></i></a>';

                    return $edit . $delete;
                })
                ->rawColumns(['actions'])
                ->addIndexColumn()
                ->make(true);
        }
        $car_types = CarType::all();

        return view('admin.car_types.index', [
            'car_types' => $car_types,
            'menu' => 'car_types',
            'location_title' => 'أنواع المركبات',
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
            'name' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'year' => ['required', 'max:255'],
        ], [
            'name.required'=>'الاسم مطلوب',
            'name.string'=>'الاسم يجب ان يكون نص',
            'name.max'=>'الاسم يجب ان لا يزيد عن 255 حرف',

            'model.required'=>'الموديل مطلوب',
            'model.string'=>'الموديل يجب ان يكون نص',
            'model.max'=>'الموديل يجب ان لا يزيد عن 255 حرف',

            'year.required' => 'سنة الصنع مطلوب',
            'year.max'=>'سنة الصنع يجب ان لا يزيد عن 255 حرف',

        ]);

        $car_type = CarType::create($request->all());
        if (!empty($car_type)) {
            return response()->json([
                'status' => true,
                'car_type_id' => $car_type->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'car_type_id' => $car_type->id,
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
        return CarType::findOrFail($id);
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
            'name' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'year' => ['required', 'max:255'],
        ], [
            'name.required'=>'الاسم مطلوب',
            'name.string'=>'الاسم يجب ان يكون نص',
            'name.max'=>'الاسم يجب ان لا يزيد عن 255 حرف',

            'model.required'=>'الموديل مطلوب',
            'model.string'=>'الموديل يجب ان يكون نص',
            'model.max'=>'الموديل يجب ان لا يزيد عن 255 حرف',

            'year.required' => 'سنة الصنع مطلوب',
            'year.max'=>'سنة الصنع يجب ان لا يزيد عن 255 حرف',

        ]);

        $car = CarType::findorFail($id);
        $car->update($request->all());

        if (!empty($car)) {
            return response()->json([
                'status' => true,
                'car_type_id' => $car->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'car_type_id' => $car->id,
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
        $car = CarType::findorFail($id);
        $car->delete();
    }

    public function destroyAll(Request $request)
    {
        $carType_id_array = $request->input('id');
        $carType = CarType::whereIn('id', $carType_id_array);
        $carType->delete();

    }
}
