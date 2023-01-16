<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarInsurance;
use Illuminate\Http\Request;

class CarInsurancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $car_insurance = CarInsurance::all();

            return datatables()->of($car_insurance)
                ->addcolumn('actions', function (CarInsurance $carInsurance) {
                    $edit = '<a href="javascript:void(0);"  class="btn btn-light-dark btn-icon btn-sm m-1 btn-flat-dark waves-effect editRecord" data-bs-toggle= "modal" data-id= "' . $carInsurance->id . '" title="تعديل "><i class="la la-edit"></i></a>';

                    $delete = '<a href="javascript:void(0);" class="btn btn-light-danger btn-icon btn-sm m-1 btn-flat-dark waves-effect deleteRecord" data-bs-toggle= "modal" id= "' . $carInsurance->id . '" title="حذف "><i class="la la-trash"></i></a>';

                    return $edit . $delete;
                })
                ->rawColumns(['actions'])
                ->addIndexColumn()
                ->make(true);
        }
        $car_insurance = CarInsurance::all();

        return view('admin.car_insurances.index', [
            'car_insurances' => $car_insurance,
            'menu' => 'car_insurances',
            'location_title' => 'أنواع التأمين',
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
        ],[
            'name.required' => 'الاسم مطلوب',
            'name.string' => 'الاسم يجب ان يكون نص',
            'name.max' => 'الاسم يجب ان لا يزيد عن 255 حرف',
        ]);

        $carInsurance = CarInsurance::create($request->all());
        if (!empty($carInsurance)) {
            return response()->json([
                'status' => true,
                'car_insurance_id' => $carInsurance->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'car_insurance_id' => $carInsurance->id,
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
        return CarInsurance::findOrFail($id);
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
        ],[
            'name.required' => 'الاسم مطلوب',
            'name.string' => 'الاسم يجب ان يكون نص',
            'name.max' => 'الاسم يجب ان لا يزيد عن 255 حرف',
        ]);

        $carInsurance = CarInsurance::findorFail($id);
        $carInsurance->update($request->all());
        if (!empty($carInsurance)) {
            return response()->json([
                'status' => true,
                'car_insurance_id' => $carInsurance->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'car_insurance_id' => $carInsurance->id,
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
        $carInsurance = CarInsurance::findorFail($id);
        $carInsurance->delete();

    }

    public function destroyAll(Request $request)
    {
        $car_insurance_id_array = $request->input('id');
        $car_insurance = CarInsurance::whereIn('id', $car_insurance_id_array);
        $car_insurance->delete();

    }
}
