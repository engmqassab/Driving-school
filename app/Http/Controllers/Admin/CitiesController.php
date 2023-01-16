<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Citie;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $citie = Citie::all();

            return datatables()->of($citie)
                ->addcolumn('actions', function (Citie $citie) {
                    $edit = '<a href="javascript:void(0);"  class="btn btn-light-dark btn-icon btn-sm m-1 btn-flat-dark waves-effect editRecord" data-bs-toggle= "modal" data-id= "' . $citie->id . '" title="تعديل "><i class="la la-edit"></i></a>';

                    $delete = '<a href="javascript:void(0);" class="btn btn-light-danger btn-icon btn-sm m-1 btn-flat-dark waves-effect deleteRecord" data-bs-toggle= "modal" id= "' . $citie->id . '" title="حذف "><i class="la la-trash"></i></a>';

                    return $edit . $delete;
                })
                ->rawColumns(['actions'])
                ->addIndexColumn()
                ->make(true);
        }
        $citie = Citie::all();

        return view('admin.cities.index', [
            'citie' => $citie,
            'menu' => 'cities',
            'location_title' => 'المدن',
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

        $citie = Citie::create($request->all());
        if (!empty($citie)) {
            return response()->json([
                'success' => true,
                'citie_id' => $citie->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'citie_id' => $citie->id,
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
        return Citie::findOrFail($id);
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

        $citie = Citie::findorFail($id);
        $citie->update($request->all());
        if (!empty($citie)) {
            return response()->json([
                'success' => true,
                'citie_id' => $citie->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'citie_id' => $citie->id,
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
        $citie = Citie::findorFail($id);
        $citie->delete();

    }
    public function destroyAll(Request $request)
    {
        $citie_id_array = $request->input('id');
        $citie = Citie::whereIn('id', $citie_id_array);
        $citie->delete();

    }
}
