<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function getpermissiongroup()
    {
        $permission_groups = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
        return $permission_groups;
    }

    public static function getpermissionByGroupName($group_name)
    {
        $permissions = DB::table('permissions')->select('name', 'id')->where('group_name', $group_name)->get();
        return $permissions;
    }

    public static function RoleHasPermission($role, $permissions)
    {
        // تأكد من أن $role هو كائن وليس مجموعة
        if ($role instanceof \Illuminate\Database\Eloquent\Collection) {
            // إذا كان مجموعة، استرجع العنصر الأول فقط
            $role = $role->first();
        }

        $hasPermission = true;

        foreach ($permissions as $permission) {
            if (!$role || !$role->hasPermissionTo($permission->name)) {
                $hasPermission = false;
            }
        }

        return $hasPermission;
    }


}
