<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CheckType;
use Illuminate\Http\Request;

class CheckTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $check_type = CheckType::all();

            return datatables()->of($check_type)
                ->addcolumn('actions', function (CheckType $checkType) {
                    $edit = '<a href="javascript:void(0);"  class="btn btn-light-dark btn-icon btn-sm m-1 btn-flat-dark waves-effect editRecord" data-bs-toggle= "modal" data-id= "' . $checkType->id . '" title="تعديل "><i class="la la-edit"></i></a>';

                    $delete = '<a href="javascript:void(0);" class="btn btn-light-danger btn-icon btn-sm m-1 btn-flat-dark waves-effect deleteRecord" data-bs-toggle= "modal" id= "' . $checkType->id . '" title="حذف "><i class="la la-trash"></i></a>';

                    return $edit . $delete;
                })
                ->rawColumns(['actions'])
                ->addIndexColumn()
                ->make(true);
        }
        $check_type = CheckType::all();

        return view('admin.check_types.index', [
            'check_types' => $check_type,
            'menu' => 'check_types',
            'location_title' => 'أنواع الفحوصات',
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

        $checkType = CheckType::create($request->all());
        if (!empty($checkType)) {
            return response()->json([
                'success' => true,
                'check_type_id' => $checkType->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'check_type_id' => $checkType->id,
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
        return CheckType::findOrFail($id);

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

        $checkType = CheckType::findorFail($id);
        $checkType->update($request->all());
        if (!empty($checkType)) {
            return response()->json([
                'success' => true,
                'check_type_id' => $checkType->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'check_type_id' => $checkType->id,
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
        $checkType = CheckType::findorFail($id);
        $checkType->delete();

    }
    public function destroyAll(Request $request)
    {
        $checkResult_id_array = $request->input('id');
        $checkType = CheckType::whereIn('id', $checkResult_id_array);
        $checkType->delete();

    }
}
