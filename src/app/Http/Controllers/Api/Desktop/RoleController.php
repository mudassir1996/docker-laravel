<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeRole;
use App\Models\Outlet;
use App\Models\PermissionRole;
use App\Models\Roles;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        if (auth()->user()->employee_id) {
            $outlet = Employee::where('employees.id', auth()->user()->employee_id)
                ->join('outlets', 'outlets.id', 'employees.outlet_id')
                ->select('outlets.id')
                ->first();
        } else {

            $outlet = Outlet::where('created_by', auth()->user()->id)->pluck('id');
        }
        if ($outlet) {
            $roles = Roles::datasync()->whereIn('outlet_id', $outlet)->get();

            return response()->json(
                [
                    'Roles' => $roles,
                ]
            );
        }
    }
    public function store(Request $request)
    {
        $data = array();
        foreach ($request->all() as $field) {
            $check_role = Roles::where('id', $field['id'])
                ->where('role_title', $field['role_title'])
                ->where('outlet_id', $field['outlet_id'])
                ->first();
            if ($check_role) {
                continue;
            } else {

                $data[] = [
                    'role_title' => $field['role_title'],
                    'description' => $field['description'],
                    'outlet_id' => $field['outlet_id'],
                    'created_by' => $field['created_by'],
                    'created_at' => $field['created_at'],
                    'updated_at' => $field['updated_at'],
                ];
            }
        }
        $roles = Roles::insert($data);
        $new_records = Roles::orderBy('id', 'desc')->take(count($data))->get();
        $sorted = $new_records->sortBy([
            ['id', 'asc']
        ]);
        return response()->json(
            ['Roles' => $sorted->values()->all()]
        );
    }

    public function update(Request $request)
    {
        foreach ($request->all() as $field) {

            $roles = Roles::where('id', $field['id'])->update([
                'role_title' => $field['role_title'],
                'description' => $field['description'],
                'outlet_id' => $field['outlet_id'],
                'created_by' => $field['created_by'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at'],
            ]);
        }
        return response(["ResponseSuccess" => "success"]);
    }

    public function get_permission_roles()
    {
        if (auth()->user()->employee_id) {
            $outlet = Employee::where('employees.id', auth()->user()->employee_id)
                ->join('outlets', 'outlets.id', 'employees.outlet_id')
                ->select('outlets.id')
                ->first();
        } else {

            $outlet = Outlet::where('created_by', auth()->user()->id)->pluck('id');
        }
        if ($outlet) {
            $permission_roles = PermissionRole::datasync()->leftJoin('roles', 'roles.id', 'permission_roles.roles_id')->whereIn('roles.outlet_id', $outlet)->select('permission_roles.*')->get();

            return response()->json(
                [
                    'PermissionRoles' => $permission_roles,
                ]
            );
        }
    }
    public function set_permission_roles(Request $request)
    {
        $data = array();
        foreach ($request->all() as $field) {
            $checkPermissionRole = PermissionRole::whereIn('roles_id', $field['roles_id'])
                ->whereIn('permissions_id', $field['permissions_id'])
                ->first();
            if (!$checkPermissionRole) {
                $data[] = [
                    'roles_id' => $field['roles_id'],
                    'permissions_id' => $field['permissions_id'],
                    'created_at' => $field['created_at'],
                    'updated_at' => $field['updated_at'],
                ];
            }
        }
        $permission_roles = PermissionRole::insert($data);
        $new_records = PermissionRole::orderBy('id', 'desc')->take(count($data))->get();
        $sorted = $new_records->sortBy([
            ['id', 'asc']
        ]);
        return response()->json(
            ['PermissionRoles' => $sorted->values()->all()]
        );
    }
    public function update_permission_roles(Request $request)
    {
        foreach ($request->all() as $field) {
            $permission_role = PermissionRole::where('id', $field['id'])->update([
                'roles_id' => $field['roles_id'],
                'permissions_id' => $field['permissions_id'],
                'created_at' => $field['created_at'],
                'updated_at' => $field['updated_at'],
            ]);
        }
        return response(["ResponseSuccess" => "success"]);
    }

    public function employee_roles()
    {
        if (auth()->user()->employee_id) {
            $outlet = Employee::where('employees.id', auth()->user()->employee_id)
                ->join('outlets', 'outlets.id', 'employees.outlet_id')
                ->select('outlets.id')
                ->first();
        } else {

            $outlet = Outlet::where('created_by', auth()->user()->id)->pluck('id');
        }
        if ($outlet) {
            $employee_roles = EmployeeRole::datasync()->leftJoin('roles', 'roles.id', 'employee_roles.roles_id')->whereIn('roles.outlet_id', $outlet)->select('employee_roles.*')->get();

            return response()->json(
                [
                    'EmployeeRoles' => $employee_roles,
                ]
            );
        }
    }
}
