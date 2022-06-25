<?php

namespace App\Http\Controllers;

use App\Classes\Subscriber;
use App\Models\Employee;
use App\Models\PermissionRole;
use App\Models\Permissions;
use App\Models\Roles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class RolesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('employee_management_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $roles = Roles::with('employees')->select('roles.*', 'outlets.outlet_title', 'employees.employee_name')
            ->leftJoin('outlets', 'roles.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'roles.created_by', '=', 'employees.id')
            ->where('roles.outlet_id', session('outlet_id'))
            ->get();

        // dd($roles);
        return view('pages.roles.manage_roles', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('employee_management_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $permissions = Permissions::pluck('permission_title', 'id');
        return view('pages.roles.add_roles', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $request->validate(
            [
                'role_title' => 'required',
                'permission_id' => 'required',
            ],
            [
                'role_title.required' => 'Role title is required.',
                'permission_id.required' => 'Please select a permission.',
            ]
        );
        $roles = Roles::create(
            [
                'role_title' => $request->role_title,
                'description' => $request->description,
                'outlet_id' => $request->outlet_id,
                'created_by' => $request->created_by
            ]
        );

        $roles->permissions()->sync($request->input('permission_id', []));
        $notification = array(
            'message' => 'Role added successfully!',
            'alert-type' => 'success'
        );

        //redirecting to the page with notification message
        return redirect('/outlets/roles')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('employee_management_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $role = Roles::with(['permissions', 'employees'])
            ->select('roles.*', 'outlets.outlet_title', 'users.username')
            ->leftJoin('outlets', 'roles.outlet_id', '=', 'outlets.id')
            ->leftJoin('users', 'roles.created_by', '=', 'users.id')
            ->where('roles.id', $id)
            ->where('roles.outlet_id', session('outlet_id'))
            ->firstOrFail();

        $employees_id = $role->employees->map(function ($item) {
            return $item->employee_id;
        });

        $employees = Employee::whereIn('id', $employees_id)->select('employee_name')->get();

        $assigned_employees = array();
        for ($i = 0; $i < count($employees); $i++) {
            $assigned_employees[$i] = [
                'id' => $role->employees[$i]->id,
                'employee_id' => $role->employees[$i]->employee_id,
                'employee_name' => $employees[$i]->employee_name,
                'created_at' => $role->employees[$i]->created_at
            ];
        }


        return view('pages.roles.view_role', compact('role', 'assigned_employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('employee_management_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            // dd('hello');
            abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $role = Roles::where('roles.id', $id)
            ->where('roles.outlet_id', session('outlet_id'))
            ->firstOrFail();

        $permissions = Permissions::pluck('permission_title', 'id');
        // dd($permissions);
        $role->load('permissions');
        return view('pages.roles.edit_roles', compact('permissions', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $request->validate(
            [
                'role_title' => 'required',
                'permission_id' => 'required',
            ],
            [
                'role_title.required' => 'Role title is required.',
                'permission_id.required' => 'Please select a permission.',

            ]
        );
        // dd($request->all())
        $roles = Roles::where('roles.id', $id)
            ->where('roles.outlet_id', session('outlet_id'))
            ->firstOrFail();

        $roles->role_title = $request->role_title;
        $roles->description = $request->description;
        $roles->outlet_id = $request->outlet_id;
        $roles->created_by = $request->created_by;
        $roles->save();

        $roles->permissions()->sync($request->input('permission_id', []));
        $notification = array(
            'message' => 'Changes Saved!',
            'alert-type' => 'success'
        );

        //redirecting to the page with notification message
        return redirect('/outlets/roles')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('employee_management_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $roles = Roles::where('roles.id', $id)
            ->where('roles.outlet_id', session('outlet_id'))
            ->firstOrFail();

        $permission = PermissionRole::where('roles_id', $id);
        // dd($permission);
        //setting up succes message
        if ($roles->delete() && $permission->delete()) {
            $notification = array(
                'message' => 'Role Deleted!',
                'alert-type' => 'success'
            );
        }
        //setting up succes message
        else {
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
        }

        //redirecting to the page with notification message
        return redirect('/outlets/roles')->with($notification);
    }
}
