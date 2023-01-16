<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CheckCase;
use Illuminate\Http\Request;

class CheckCasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $check_case = CheckCase::all();

            return datatables()->of($check_case)
                ->addcolumn('actions', function (CheckCase $checkCase) {
                    $edit = '<a href="javascript:void(0);"  class="btn btn-light-dark btn-icon btn-sm m-1 btn-flat-dark waves-effect editRecord" data-bs-toggle= "modal" data-id= "' . $checkCase->id . '" title="تعديل "><i class="la la-edit"></i></a>';

                    $delete = '<a href="javascript:void(0);" class="btn btn-light-danger btn-icon btn-sm m-1 btn-flat-dark waves-effect deleteRecord" data-bs-toggle= "modal" id= "' . $checkCase->id . '" title="حذف "><i class="la la-trash"></i></a>';

                    return $edit . $delete;
                })
                ->rawColumns(['actions'])
                ->addIndexColumn()
                ->make(true);
        }
        $check_case = CheckCase::all();

        return view('admin.check_cases.index', [
            'check_cases' => $check_case,
            'menu' => 'check_cases',
            'location_title' => 'حالات الفحص',
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

        $checkCase = CheckCase::create($request->all());
        if (!empty($checkCase)) {
            return response()->json([
                'success' => true,
                'check_case_id' => $checkCase->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'check_case_id' => $checkCase->id,
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
        return CheckCase::findOrFail($id);

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

        $checkCase = CheckCase::findorFail($id);
        $checkCase->update($request->all());
        if (!empty($checkCase)) {
            return response()->json([
                'success' => true,
                'check_case_id' => $checkCase->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'check_case_id' => $checkCase->id,
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
        $checkCase = CheckCase::findorFail($id);
        $checkCase->delete();

    }

    public function destroyAll(Request $request)
    {
        $checkCase_id_array = $request->input('id');
        $checkCase = CheckCase::whereIn('id', $checkCase_id_array);
        $checkCase->delete();

    }
}
