<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Log;
use Spatie\Permission\Models\Role;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = User::all();
        return view('admin.user.all_admin', compact('admin'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.add_admin', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8',
            'roles' => 'required|exists:roles,id', // التحقق من وجود الدور في جدول الأدوار
        ]);

        // إنشاء المستخدم الجديد
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        // حفظ المستخدم
        $user->save();

        // إضافة الدور للمستخدم
        $role = Role::findById($request->roles);
        $user->assignRole($role); // إضافة الدور للمستخدم

        // إشعار بالنجاح
        session()->flash('message', 'تم إنشاء المسؤول بنجاح');
        return redirect()->route('admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.user.edit_admin', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */



     public function update(Request $request, $id)
     {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|min:8',
        ]);


        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->roles()->detach();
        if ($request->roles) {
            $role = Role::find($request->roles);
            if ($role) {
                $user->syncRoles($role->name);
            }
        }
        $user->save();
        $notifications = [
            'title' => 'User Updated',
            'message' => 'User ' . $user->name . ' has been updated',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.index')->with($notifications);
     }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $user = User::find($id);
        $user->delete();
        $notifications = [
            'title' => 'User Deleted',
            'message' => 'User ' . $user->name . ' has been deleted',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.index')->with($notifications);
    }
}
