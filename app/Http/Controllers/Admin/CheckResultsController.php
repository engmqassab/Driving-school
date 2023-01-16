<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CheckResult;
use Illuminate\Http\Request;

class CheckResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $check_result = CheckResult::all();

            return datatables()->of($check_result)
                ->addcolumn('actions', function (CheckResult $checkResult) {
                    $edit = '<a href="javascript:void(0);"  class="btn btn-light-dark btn-icon btn-sm m-1 btn-flat-dark waves-effect editRecord" data-bs-toggle= "modal" data-id= "' . $checkResult->id . '" title="تعديل "><i class="la la-edit"></i></a>';

                    $delete = '<a href="javascript:void(0);" class="btn btn-light-danger btn-icon btn-sm m-1 btn-flat-dark waves-effect deleteRecord" data-bs-toggle= "modal" id= "' . $checkResult->id . '" title="حذف "><i class="la la-trash"></i></a>';

                    return $edit . $delete;
                })
                ->rawColumns(['actions'])
                ->addIndexColumn()
                ->make(true);
        }
        $check_result = CheckResult::all();

        return view('admin.check_results.index', [
            'check_results' => $check_result,
            'menu' => 'check_results',
            'location_title' => 'نتائج الفحص',
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

        $checkResult = CheckResult::create($request->all());
        if (!empty($checkResult)) {
            return response()->json([
                'success' => true,
                'check_result_id' => $checkResult->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'check_result_id' => $checkResult->id,
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
        return CheckResult::findOrFail($id);
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

        $checkResult = CheckResult::findorFail($id);
        $checkResult->update($request->all());
        if (!empty($checkResult)) {
            return response()->json([
                'success' => true,
                'check_result_id' => $checkResult->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'check_result_id' => $checkResult->id,
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
        $checkResult = CheckResult::findorFail($id);
        $checkResult->delete();

    }
    public function destroyAll(Request $request)
    {
        $checkResult_id_array = $request->input('id');
        $checkResult = CheckResult::whereIn('id', $checkResult_id_array);
        $checkResult->delete();

    }
}
