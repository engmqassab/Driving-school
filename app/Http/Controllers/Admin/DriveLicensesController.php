<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DriveLicense;
use Illuminate\Http\Request;

class DriveLicensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $drive_license = DriveLicense::all();

            return datatables()->of($drive_license)
                ->addcolumn('actions', function (DriveLicense $driveLicense) {
                    $edit = '<a href="javascript:void(0);"  class="btn btn-light-dark btn-icon btn-sm m-1 btn-flat-dark waves-effect editRecord" data-bs-toggle= "modal" data-id= "' . $driveLicense->id . '" title="تعديل "><i class="la la-edit"></i></a>';

                    $delete = '<a href="javascript:void(0);" class="btn btn-light-danger btn-icon btn-sm m-1 btn-flat-dark waves-effect deleteRecord" data-bs-toggle= "modal" id= "' . $driveLicense->id . '" title="حذف "><i class="la la-trash"></i></a>';

                    return $edit . $delete;
                })
                ->rawColumns(['actions'])
                ->addIndexColumn()
                ->make(true);
        }
        $drive_license = DriveLicense::all();

        return view('admin.drive_licenses.index', [
            'drive_license' => $drive_license,
            'menu' => 'drive_license',
            'location_title' => 'تراخيص القيادة',
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

        $driveLicense = DriveLicense::create($request->all());
        if (!empty($driveLicense)) {
            return response()->json([
                'success' => true,
                'drive_license_id' => $driveLicense->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'drive_license_id' => $driveLicense->id,
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
        return DriveLicense::findOrFail($id);
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

        $driveLicense = DriveLicense::findorFail($id);
        $driveLicense->update($request->all());
        if (!empty($driveLicense)) {
            return response()->json([
                'success' => true,
                'drive_license_id' => $driveLicense->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'drive_license_id' => $driveLicense->id,
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
        $driveLicense = DriveLicense::findorFail($id);
        $driveLicense->delete();

    }
    public function destroyAll(Request $request)
    {
        $driveLicense_id_array = $request->input('id');
        $driveLicense = DriveLicense::whereIn('id', $driveLicense_id_array);
        $driveLicense->delete();

    }
}
