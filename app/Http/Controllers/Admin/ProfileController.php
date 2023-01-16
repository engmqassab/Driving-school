<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile',['menu' => '', 'location_title' =>'الملف الشخصي'])->with('window', 1);
    }

    public function updatePassword(Request $request)
    {


        $validation = $request->validate([
            'current_password' => ['required'],
            'old_password' => ['required'],
            'password' => ['required', 'min:8', 'confirmed'], // password_confirmation
        ],[
            'current_password.required' => 'كلمة المرور القديمة مطلوب',
            'old_password.required' => 'كلمة المرور الحالية مطلوب',
            'password.required' => 'كلمة المرور الجديدة مطلوب',
            'password.confirmed' => 'كلمة المرور الجديدة غير متطابقة',
            'password.min' => 'كلمة المرور الجديدة لا يجب ان تقل عن 8 حروف ',

        ]);

        if (Hash::check($request->input('old_password'), Auth::user()->password)) {
            toastr()->error('يرجى التاكد من ادخال البيانات');
        } else {
                if (Hash::check($request->input('current_password'), Auth::user()->password)) {
                    $user = User::findOrFail(Auth::id());
                    $user->update([
                        'password' => Hash::make($request->input('password')),
                    ]);

                    toastr()->success('تم العملية بنجاح');
                } else {
                    toastr()->error('كلمة المرور الحالية غير صحيحة');
                }

        }

        return redirect()->back()->with('window', 1);
    }

    public function updatePersonal(Request $request)
    {
        $user_id = Auth::id();
        $validation = $request->validate([
            'password' => ['required'],
            'name' => ['required'],
            'username' => "required|unique:users,username,$user_id",
            'email' => "required|unique:users,email,$user_id|email",
        ],[
            'password.required' => 'كلمة المرور مطلوب',
            'name.required' => 'الاسم مطلوب',
            'username.required' => 'اسم المستخدم مطلوب',
            'username.unique' => 'أسم المستخدم غير متاح ',
            'email.required' => 'الايميل مطلوب',
            'email.unique' => 'الايميل غير متاح ',
            'email.email' => 'الايميل غير صالح ',

        ]);

            $data = $request->except('password');
            if (Hash::check($request->input('password'), Auth::user()->password)) {
                $user = User::findOrFail($user_id);

                $user->update($data);


                toastr()->success('تم العملية بنجاح');
            } else {
                toastr()->error('كلمة المرور الحالية غير صحيحة');
            }

        return redirect()->back()->with('window', 2);
    }
}
