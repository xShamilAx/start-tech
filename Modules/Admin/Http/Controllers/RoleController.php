<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Auth;
use App\Models\PermissionModel;
use App\Models\RoleModel;
use DB;
use Illuminate\Support\Facades\Validator;


class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        PermissionModel::checkPermission($request , 'MANAGE_ROLES');
        return view('admin::role.role_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        PermissionModel::checkPermission($request , 'ADD_ROLE');
        $allPermissions = PermissionModel::all();

        $permissionsArray = $this->buildPermissionArrayTree($allPermissions);

        $parent_roles = RoleModel::pluck('display_name', 'id');
        $parent_roles[0] = 'Top Level';

        $permissionTree = $this->buildPermissionTree($permissionsArray);

        return view('admin::role.create_role')->with('permission', $permissionTree)->with('parent_roles', $parent_roles);
    }

    function buildPermissionArrayTree($permissions, $parentId = 0)
    {
        $permissionArray = array();

        $i = 0;
        foreach ($permissions as $permission) {


            if ($permission->parent_id == $parentId) {
                $children = $this->buildPermissionArrayTree($permissions, $permission->id);

                if ($children) {
                    $permissionArray[$i]['children'] = $children;
                }
                $permissionArray[$i]['id'] = $permission->id;
                $permissionArray[$i]['display_name'] = $permission->display_name;
                $permissionArray[$i]['name'] = $permission->name;
                //unset($elements[$element->id]);
            }
            $i++;
        }

        return $permissionArray;
    }

    public function buildPermissionTree($permissionsArray, $role_id = NULL)
    {
        $permission = '';
        $childpermission = '';
        $i = 0;

        if ($role_id != NULL)
            $role_permissions = RoleModel::find($role_id);

        foreach ($permissionsArray as $permissionArray) {
            $childpermission = '';
            if (isset($permissionArray['children'])) {
                foreach ($permissionArray['children'] as $child) {
                    $test = '';
                    if (isset($child['children'])) {
                        $test = $this->buildPermissionTree($child['children'], $role_id);
                    }

                    if ($role_id != NULL) {

                        if ($role_permissions->hasPermissionTo($child["name"])) {
                            $childpermission = $childpermission . '{title:"' . $child["display_name"] . '",selected: true, preselected: true, key:"' . $child["id"] . '",children: [' . $test . ']},';
                        } else {
                            $childpermission = $childpermission . '{title:"' . $child["display_name"] . '", key:"' . $child["id"] . '",children: [' . $test . ']},';
                        }
                    } else {
                        $childpermission = $childpermission . '{title:"' . $child["display_name"] . '", key:"' . $child["id"] . '",children: [' . $test . ']},';
                    }
                }
            } else {
                $childpermission = '';
            }

            if ($role_id != NULL) {
                if ($role_permissions->hasPermissionTo($permissionArray["name"])) {
                    $permission = $permission . '{title:"' . $permissionArray["display_name"] . '",selected: true, expanded: true , preselected: true, key:"' . $permissionArray["id"] . '" , children: [' . $childpermission . ']},';
                } else {
                    $permission = $permission . '{title:"' . $permissionArray["display_name"] . '", key:"' . $permissionArray["id"] . '" ,expanded: true, children: [' . $childpermission . ']},';
                }
            } else {
                $permission = $permission . '{title:"' . $permissionArray["display_name"] . '", key:"' . $permissionArray["id"] . '" ,expanded: true,  children: [' . $childpermission . ']},';
            }
        }

        return $permission;
    }

    public function store(Request $request)
    {
        PermissionModel::checkPermission($request , 'ADD_ROLE');
        parse_str($request['role_details'], $role_details);
        $permissions = explode(",", $role_details['permissions']);

        $validator = Validator::make($role_details, [
            'role_name' => 'required|unique:roles,name',
            'display_name' => 'required|unique:roles,display_name',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()->all()]);
        }


        $role = new RoleModel();
        $role->name = $role_details['role_name'];
        $role->display_name = $role_details['display_name'];
        $role->description = $role_details['description'];
        try {
            $role->save();
            $role->syncPermissions($permissions);

            return response()->json(['status' => 'success', 'msg' => 'Saved Successfully', 'code' => $role->id]);
        } catch (\Exception $e) {

            return response()->json(['status' => 'error', 'msg' => 'Something went Wrong']);
        }
    }

    public function getRoles(Request $request)
    {
        PermissionModel::checkPermission($request , 'EDIT_ROLE');
        $roles = RoleModel::select('id', 'name', 'display_name', 'description')->get();
        $edit_role_permission = true;
        if (Auth::user()->can('EDIT_ROLE')) {
            $edit_role_permission = true;
        }

        return Datatables::of($roles)
            ->addColumn('action', function ($roles) use ($edit_role_permission) {
                if ($edit_role_permission) {
                    return '<a class="btn btn-info btn-xs" href="' . url("admin/roles/" . $roles->id . "/edit") . '"  data-toggle="tooltip" data-placement="left" title="" data-original-title="Update">
                                <i class="fas fa-edit"></i></a> ';
                }
            })

            ->make(true);
    }


    public function show($id)
    {
        //
    }


    public function edit(Request $request, $id)
    {
        PermissionModel::checkPermission($request , 'EDIT_ROLE');
        $allPermissions = PermissionModel::all();
        $permissionsArray = $this->buildPermissionArrayTree($allPermissions);

        $parent_roles = RoleModel::where('id', '!=', $id)->pluck('display_name', 'id');
        $parent_roles[0] = 'Top Level';

        $permissionTree = $this->buildPermissionTree($permissionsArray, $id);
        $role = RoleModel::find($id);

        return view('admin::role.create_role')->with('permission', $permissionTree)->with('role', $role)->with('parent_roles', $parent_roles);
    }


    public function update(Request $request, $id)
    {
        PermissionModel::checkPermission($request , 'EDIT_ROLE');
        parse_str($request['role_details'], $role_details);
        $validator = Validator::make($role_details, [
            'role_name' => 'required|unique:roles,name,' . $id,
            'display_name' => 'required|unique:roles,display_name,' . $id,

        ]);

        if (!$validator->passes()) {

            return response()->json(['status' => 'error', 'errors' => $validator->errors()->all()]);
        }
        DB::table('role_has_permissions')->where('role_id', $id)->delete();

        $permissions = explode(",", $role_details['permissions']);

        $role = RoleModel::find($id);
        $role->name = $role_details['role_name'];
        $role->display_name = $role_details['display_name'];
        $role->description = $role_details['description'];
        //   $role->parent_id = $role_details['parent_role'];


        try {
            $role->save();
            $role->syncPermissions($permissions);

            return response()->json(['status' => 'success', 'msg' =>'Updated Successfully', 'code' => $role->id]);
        } catch (\Exception $e) {

            return response()->json(['status' => 'error', 'msg' => 'Something went Wrong']);
        }
    }


    public function destroy($id)
    {
        //
    }

}
