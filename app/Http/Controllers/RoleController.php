<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(Request $request)
    {

        $permissions = Permission::latest();

        if (!empty($request->get('keyword'))) {
            $permissions = $permissions->where('group_name', 'like', '%' . $request->get('keyword') . '%');
        }

        $permissions = $permissions->paginate(10);

        return view('admin.permission.all_permission', compact('permissions'));
    }
    public function destroy($id)
    {
        Permission::findOrFail($id)->delete();
        $notifications = [
            'message' => 'Permission deleted successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notifications);
    }

    //////////////////////////
    public function createrole()
    {
        return view('admin.role.add_role');
    }

    public function storerole(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $role = new Role();
        $role->name = $request->input('name');
        $role->save();
        $notifications = [
            'message' => 'Role created successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('role.index')->with($notifications);
    }


    public function indexrole()
    {
        $roles = Role::get();
        return view('admin.role.all_role', compact('roles'));
    }

    public function editrole($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.role.edit_role', compact('role'));
    }

    public function updaterole(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->save();
        $notifications = [
            'message' => 'Role updated successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('role.index')->with($notifications);
    }

    public function destroyrole($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        $notifications = [
            'message' => 'Role deleted successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('role.index')->with($notifications);
    }

    public function createrolepermission()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_group = User::getpermissiongroup();
        return view('admin.rolesetup.add_role_permissions', compact('roles', 'permissions', 'permission_group'));
    }

    public function storerolepermission(Request $request)
    {
        $data = array();
        $permission = $request->permission;

        foreach ($permission as $item) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;
            DB::table('role_has_permissions')->insert($data);
        }
        $notifications = [
            'message' => 'Role Permission Added Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('index.pemission.store')->with($notifications);
    }

    public function indexrolepermission()
    {
        $role = Role::all();
        return view('admin.rolesetup.all_role_permssions', compact('role'));
    }

    public function destroyrolepermission($id)
    {
        $role = Role::findOrFail($id);
        $role->permissions()->detach();
        $notifications = [
            'message' => 'Role Permission Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('index.pemission.store')->with($notifications);
    }

    public function editrolepermissions($id)
    {
        $role = Role::findOrFail($id);
        $permission = Permission::all();
        $permission_group = User::getpermissiongroup();

        return view('admin.rolesetup.edit_role_permissione', compact('role', 'permission', 'permission_group'));
    }



}
