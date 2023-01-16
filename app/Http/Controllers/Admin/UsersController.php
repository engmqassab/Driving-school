<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CheckType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $users = User::all();

            return datatables()->of($users)
                ->addcolumn('actions', function (User $user) {
                    $edit = '<a href="javascript:void(0);" class="btn btn-light-dark btn-icon btn-sm m-1 btn-flat-dark waves-effect editRecord" data-bs-toggle= "modal"  data-id= "' . $user->id . '" title="تعديل ">
                            <i class="la la-edit"></i>
                            </a>';

                    $delete = '';
                    if (Auth::id() != $user->id) {
                        $delete = '<a href="javascript:void(0);" class="btn btn-light-danger btn-icon btn-sm m-1 btn-flat-dark waves-effect deleteRecord" data-bs-toggle= "modal" id= "' . $user->id . '" title="حذف ">
                                    <i class="la la-trash"></i>
                                    </a>';
                    }
                    return $edit . $delete;
                })
                ->addcolumn('auth_id', function (User $user) {

                    return Auth::id();
                })
                ->rawColumns(['actions'])
                ->addIndexColumn()
                ->make(true);
        }
        $users = User::all();

        return view('admin.users.index', [
            'users' => $users,
            'menu' => 'users',
            'location_title' => 'كل المستخدمين',
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
                'email' => ['required', 'email', "unique:users,email"],
                'username' => ['required', 'string', "unique:users,username","alpha_dash"],
                'password' => ['required', 'min:8', 'string'],
            ],[
                'name.required' => 'الاسم مطلوب',
                'name.string' => 'الاسم يجب ان يكون نص',
                'name.max' => 'الاسم يجب ان لا يزيد عن 255 حرف',

                'email.required' => 'البريد الالكتروني مطلوب',
                'email.email' => 'البريد الالكتروني غير صالح',
                'email.unique' => 'البريد الالكتروني مستخدم مسبقا',

                'username.required' => 'اسم المستخدم مطلوب',
                'username.string' => 'اسم المستخدم يجب ان يكون نص',
                'username.unique' => 'اسم المستخدم مستخدم مسبقا',
                'username.alpha_dash' => 'اسم المستخدم غير صالح',

                'password.required' => 'كلمة المرور مطلوب',
                'password.string' => 'كلمة المرور يجب ان يكون نص',
                'password.min' => 'كلمة المرور يجب ان لا يزيد عن 8 حرف',
                'password.max' => 'كلمة المرور يجب ان لا يزيد عن 255 حرف',


            ]);

        $data = $request->except('password');
        $data['password']= Hash::make($request->password);

        $user = User::create($data);

        if (!empty($user)) {
            return response()->json([
                'status' => true,
                'user_id' => $user->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'user_id' => $user->id,
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
        return User::findOrFail($id);
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
            'email' => ['required', 'min:10', 'email', "unique:users,email,$id"],
            'username' => ['required', 'string', "unique:users,username,$id","alpha_dash"],
        ],[
            'name.required' => 'الاسم مطلوب',
            'name.string' => 'الاسم يجب ان يكون نص',
            'name.max' => 'الاسم يجب ان لا يزيد عن 255 حرف',

            'email.required' => 'البريد الالكتروني مطلوب',
            'email.email' => 'البريد الالكتروني يجب ان يكون نص',
            'email.unique' => 'البريد الالكتروني مستخدم مسبقا',

            'username.required' => 'اسم المستخدم مطلوب',
            'username.string' => 'اسم المستخدم يجب ان يكون نص',
            'username.unique' => 'اسم المستخدم مستخدم مسبقا',
            'username.alpha_dash' => 'اسم المستخدم غير صالح',

            'password.required' => 'كلمة المرور مطلوب',
            'password.string' => 'كلمة المرور يجب ان يكون نص',
            'password.min' => 'كلمة المرور يجب ان لا يزيد عن 8 حرف',
            'password.max' => 'كلمة المرور يجب ان لا يزيد عن 255 حرف',


        ]);
        $user = User::findOrFail($id);
        $data = $request->except('password');

        if(!empty($request->password)){
            $request->validate([
                'password' => ['required', 'min:8', 'string'],
            ],[

                'password.required' => 'كلمة المرور مطلوب',
                'password.string' => 'كلمة المرور يجب ان يكون نص',
                'password.min' => 'كلمة المرور يجب ان لا يزيد عن 8 حرف',
                'password.max' => 'كلمة المرور يجب ان لا يزيد عن 255 حرف',


            ]);
            $data['password']= Hash::make($request->password);

        }
        $user->update($data);


        if (!empty($user)) {
            return response()->json([
                'status' => true,
                'user_id' => $user->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'user_id' => $user->id,
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

        $data = User::findOrFail($id)->delete();
    }
    public function destroyAll(Request $request)
    {
        $user_array = $request->input('id');
        $user = User::whereIn('id', $user_array);
        $user->delete();

    }
}
