<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarLicense;
use Illuminate\Http\Request;

class CarLicensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $car_license = CarLicense::all();

            return datatables()->of($car_license)
                ->addcolumn('actions', function (CarLicense $carLicense) {
                    $edit = '<a href="javascript:void(0);"  class="btn btn-light-dark btn-icon btn-sm m-1 btn-flat-dark waves-effect editRecord" data-bs-toggle= "modal" data-id= "' . $carLicense->id . '" title="تعديل "><i class="la la-edit"></i></a>';

                    $delete = '<a href="javascript:void(0);" class="btn btn-light-danger btn-icon btn-sm m-1 btn-flat-dark waves-effect deleteRecord" data-bs-toggle= "modal" id= "' . $carLicense->id . '" title="حذف "><i class="la la-trash"></i></a>';

                    return $edit . $delete;
                })
                ->rawColumns(['actions'])
                ->addIndexColumn()
                ->make(true);
        }
        $car_license = carLicense::all();

        return view('admin.car_licenses.index', [
            'car_licenses' => $car_license,
            'menu' => 'car_licenses',
            'location_title' => 'أنواع التراخيص',
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

        $car_license = CarLicense::create($request->all());
        if (!empty($car_license)) {
            return response()->json([
                'status' => true,
                'car_license_id' => $car_license->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'car_license_id' => $car_license->id,
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
        return CarLicense::findOrFail($id);
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

        $carLicense = CarLicense::findorFail($id);
        $carLicense->update($request->all());
        if (!empty($carLicense)) {
            return response()->json([
                'status' => true,
                'car_license_id' => $carLicense->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'car_license_id' => $carLicense->id,
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
        $carLicense = CarLicense::findorFail($id);
        $carLicense->delete();
        
    }

    public function destroyAll(Request $request)
    {
        $carLicense_id_array = $request->input('id');
        $carLicense = CarLicense::whereIn('id', $carLicense_id_array);
        $carLicense->delete();

    }
}
