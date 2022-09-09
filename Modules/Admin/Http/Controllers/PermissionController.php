<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PermissionModel;
use Illuminate\Support\Facades\Validator;
use Auth;
use Spatie\Permission\Guard;


class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        PermissionModel::checkPermission($request , 'MANAGE_PERMISSIONS');
        $permissions = PermissionModel::where('parent_id', '=', 0)->get();
        return view('admin::permission.permission_list')->with('permissions', $permissions);
    }


    public function create(Request $request)
    {
        PermissionModel::checkPermission($request , 'ADD_PERMISSION');
        return view('admin::permission.create_permission');
    }


    public function store(Request $request)
    {
        PermissionModel::checkPermission($request , 'ADD_PERMISSION');
        parse_str($request['permission_details'], $permission_details);
        $validator = Validator::make($permission_details, [
            'permission_name' => 'required|unique:permissions,name',
            'display_name' => 'required|unique:permissions,display_name',
            'parent_permission' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()->all()]);
        }

        $permission = new PermissionModel();
        $permission->name = preg_replace('/\s+/', '', $permission_details['permission_name']);
        $permission->display_name = $permission_details['display_name'];
        $permission->guard_name = $attributes['guard_name'] ?? Guard::getDefaultName(static::class);
        $permission->description = $permission_details['description'];
        $permission->parent_id = $permission_details['parent_permission'];
        try {
            $permission->save();
            return response()->json(['status' => 'success', 'msg' => 'Saved Successfully']);
        } catch (\Exception $e) {

            //dd($e->getMessage());
            return response()->json(['status' => 'error', 'msg' => 'Something went Wrong']);
        }

    }

    public function show($id)
    {
        //
    }


    public function edit(Request $request, $id)
    {
        PermissionModel::checkPermission($request , 'EDIT_PERMISSION');
        $permission = PermissionModel::find($id);
        return view('admin::permission.create_permission')->with('permission', $permission);
    }


    public function update(Request $request, $id)
    {
        PermissionModel::checkPermission($request , 'EDIT_PERMISSION');
        parse_str($request['permission_details'], $permission_details);
        $validator = Validator::make($permission_details, [
            'permission_name' => 'required|unique:permissions,name,'.$id,
            'display_name' => 'required|unique:permissions,display_name,'.$id,
            'parent_permission' => 'required',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()->all()]);
        }
        $permission = PermissionModel::find($id);
        $permission->name = preg_replace('/\s+/', '', $permission_details['permission_name']);
        $permission->guard_name = $attributes['guard_name'] ?? Guard::getDefaultName(static::class);
        $permission->display_name = $permission_details['display_name'];
        $permission->description = $permission_details['description'];
        $permission->parent_id = $permission_details['parent_permission'];
        try {
            $permission->save();
            return response()->json(['status' => 'success', 'msg' => 'Updated Successfully']);
        } catch (\Exception $e) {
            //dd($e->getMessage());
            return response()->json(['status' => 'error', 'msg' => 'Something went Wrong']);
        }
    }


    public function destroy(Request $request, $id)
    {
        PermissionModel::checkPermission($request , 'DELETE_PERMISSION');
        $permission = PermissionModel::find($id);
        $permission->delete();
    }

}
