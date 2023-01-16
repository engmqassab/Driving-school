<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransferType;
use Illuminate\Http\Request;

class TransferTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $transfer_type = TransferType::all();

            return datatables()->of($transfer_type)
                ->addcolumn('actions', function (TransferType $transferType) {
                    $edit = '<a href="javascript:void(0);"  class="btn btn-light-dark btn-icon btn-sm m-1 btn-flat-dark waves-effect editRecord" data-bs-toggle= "modal" data-id= "' . $transferType->id . '" title="تعديل "><i class="la la-edit"></i></a>';

                    $delete = '<a href="javascript:void(0);" class="btn btn-light-danger btn-icon btn-sm m-1 btn-flat-dark waves-effect deleteRecord" data-bs-toggle= "modal" id= "' . $transferType->id . '" title="حذف "><i class="la la-trash"></i></a>';

                    return $edit . $delete;
                })
                ->rawColumns(['actions'])
                ->addIndexColumn()
                ->make(true);
        }
        $transfer_type = TransferType::all();

        return view('admin.transfer_types.index', [
            'transfer_types' => $transfer_type,
            'menu' => 'transfer_types',
            'location_title' => 'أنواع النقل',
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

        $transferType = TransferType::create($request->all());
        if (!empty($transferType)) {
            return response()->json([
                'success' => true,
                'transfer_type_id' => $transferType->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'transfer_type_id' => $transferType->id,
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
        return TransferType::findOrFail($id);
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

        $transferType = TransferType::findorFail($id);
        $transferType->update($request->all());
        if (!empty($transferType)) {
            return response()->json([
                'success' => true,
                'transfer_type_id' => $transferType->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'transfer_type_id' => $transferType->id,
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
        $transferType = TransferType::findorFail($id);
        $transferType->delete();

    }
    public function destroyAll(Request $request)
    {
        $transferType_id_array = $request->input('id');
        $transferType = TransferType::whereIn('id', $transferType_id_array);
        $transferType->delete();

    }
}
