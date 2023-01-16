<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplicationCase;
use Illuminate\Http\Request;

class ApplicationCasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $application_case = ApplicationCase::all();

            return datatables()->of($application_case)
                ->addcolumn('actions', function (ApplicationCase $applicationCase) {
                    $edit = '<a href="javascript:void(0);"  class="btn btn-light-dark btn-icon btn-sm m-1 btn-flat-dark waves-effect editRecord" data-bs-toggle= "modal" data-id= "' . $applicationCase->id . '" title="تعديل "><i class="la la-edit"></i></a>';

                    $delete = '<a href="javascript:void(0);" class="btn btn-light-danger btn-icon btn-sm m-1 btn-flat-dark waves-effect deleteRecord" data-bs-toggle= "modal" id= "' . $applicationCase->id . '" title="حذف "><i class="la la-trash"></i></a>';

                    return $edit . $delete;
                })
                ->rawColumns(['actions'])
                ->addIndexColumn()
                ->make(true);
        }
        $application_case = ApplicationCase::all();

        return view('admin.application_cases.index', [
            'application_case' => $application_case,
            'menu' => 'application_cases',
            'location_title' => 'حالات الطلب',
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
            'name.required'=>'الاسم مطلوب',
            'name.string'=>'الاسم يجب ان يكون نص',
            'name.max'=>'الاسم يجب ان لا يزيد عن 255 حرف',
        ]);

        $applicationCase = ApplicationCase::create($request->all());
        if (!empty($applicationCase)) {
            return response()->json([
                'success' => true,
                'application_case_id' => $applicationCase->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'application_case_id' => $applicationCase->id,
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
        return ApplicationCase::findOrFail($id);
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
            'name.required'=>'الاسم مطلوب',
            'name.string'=>'الاسم يجب ان يكون نص',
            'name.max'=>'الاسم يجب ان لا يزيد عن 255 حرف',
        ]);

        $applicationCase = ApplicationCase::findorFail($id);
        $applicationCase->update($request->all());
        if (!empty($applicationCase)) {
            return response()->json([
                'success' => true,
                'application_case_id' => $applicationCase->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'application_case_id' => $applicationCase->id,
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
        $applicationCase = ApplicationCase::findorFail($id);
        $applicationCase->delete();

    }

    public function destroyAll(Request $request)
    {
        $applicationCase_id_array = $request->input('id');
        $applicationCase = ApplicationCase::whereIn('id', $applicationCase_id_array);
        $applicationCase->delete();

    }
}
