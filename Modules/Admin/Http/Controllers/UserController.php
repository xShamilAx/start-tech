<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Rules\BranchUniqueValidator;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Models\UserModel;
use Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        PermissionModel::checkPermission($request, 'MANAGE_USERS');
        return view('admin::user.user_list');
    }


    public function create(Request $request)
    {
        PermissionModel::checkPermission($request, 'ADD_USER');
        return view('admin::user.user_register');
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

    public function buildPermissionTree($permissionsArray, $user_id = NULL)
    {
        $permission = '';
        $childpermission = '';
        $i = 0;

        if ($user_id != NULL)
            $role_permissions = RoleModel::find($user_id);

        foreach ($permissionsArray as $permissionArray) {
            $childpermission = '';
            if (isset($permissionArray['children'])) {
                foreach ($permissionArray['children'] as $child) {
                    $test = '';
                    if (isset($child['children'])) {
                        $test = $this->buildPermissionTree($child['children'], $user_id);
                    }

                    if ($user_id != NULL) {

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

            if ($user_id != NULL) {
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
        PermissionModel::checkPermission($request, 'ADD_USER');
        parse_str($request['user_details'], $user_details);

        $validator = Validator::make($user_details, [
            'user_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_no' => 'required|unique:users,phone_no',
            'password' => 'required|confirmed',
            'role' => 'required',

        ]);

        if (!$validator->passes()) {

            return response()->json(['status' => 'error', 'errors' => $validator->errors()->all()]);
        }

        $add_user = UserModel::addUser($user_details);

        if ($add_user != FALSE)
            return response()->json(['status' => 'success', 'msg' => 'Updated Successfully']);
        else
            return response()->json(['status' => 'error', 'msg' => 'Something went Wrong']);


    }


    public function show()
    {
        $user = UserModel::find(auth()->user()->id);
        $userRole = $user->getRoleNames();
        $user->password = '';
        return view('admin::user.user_profile')->with('user', $user)->with('user_role', $userRole);
    }

    public function save_my_profile($request)
    {
        parse_str($request['user_details'], $user_details);
        $id = auth()->user()->id;
        $validator = Validator::make($user_details, [
            'user_name' => 'required',
            'email' => 'required|unique:users,id,' . $id,
            'phone_no' => 'required|unique:users,id,' . $id,
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()->all()]);
        }

        $user = UserModel::find($id);
        $userRole = $user->getRoleNames();

        $user->username = $user_details['user_name'];
        $user->first_name = $user_details['first_name'];
        $user->last_name = $user_details['last_name'];
        $user->email = $user_details['email'];
        $user->phone_no = $user_details['phone_no'];
        $user->updated_by = $id;
        $user->status = 1;
        $user->save();


        return response()->json(['status' => 'success', 'msg' => 'Updated Successfully']);

    }


    public function edit(Request $request, $id)
    {
        PermissionModel::checkPermission($request, 'EDIT_USER');
        $user = UserModel::find($id);

        $userRole = NULL;

        $userRole = $user->getRoleNames();

        $user->password = '';

        return view('admin::user.user_register')->with('user', $user)->with('user_role', $userRole);
    }


    public function update(Request $request, $id)
    {
        if (auth()->user()->id == $id)
        {
            return $this->save_my_profile($request);

        }
        else
            PermissionModel::checkPermission($request, 'EDIT_USER');
        parse_str($request['user_details'], $user_details);

        $validator = Validator::make($user_details, [
            'user_name' => 'required',
            'email' => 'required|unique:users,id,' . $id,
            'phone_no' => 'required|unique:users,id,' . $id,
            'password' => 'confirmed',
            'role' => 'required',
        ]);

        if (!$validator->passes()) {

            return response()->json(['status' => 'error', 'errors' => $validator->errors()->all()]);
        }

        $update_user = UserModel::updateUser($user_details, $id);

        if ($update_user == TRUE) {
            return response()->json(['status' => 'success', 'msg' => 'Updated Successfully']);

        } else {
            return response()->json(['status' => 'error', 'msg' => 'Something went Wrong']);

        }

    }


    public function destroy(Request $request, $id)
    {
        PermissionModel::checkPermission($request, 'DELETE_USER');
        $user = UserModel::find($id);

        if ($user->delete()) {
            return '{"status": "success", "msg": "' . __('user.messages.user_deleted') . '" , "id" : "' . $id . '"}';
        }
    }

    public function getUserList(Request $request)
    {
        PermissionModel::checkPermission($request, 'EDIT_USER');

        $users = UserModel::get();
        $edit_user_permission = false;
        if (Auth::user()->can('EDIT_USER')) {
            $edit_user_permission = true;
        }

        return Datatables::of($users)
            ->addColumn('name', function ($users) {
                return $users->first_name . ' ' . $users->last_name;
            })
            ->addColumn('role', function ($users) {
                $roles = NULL;
                if ($users->permission_type == 'R') {
                    $roles = $users->getRoleNames();
                }
                return $roles;
            })
            ->editColumn('status', function ($users) {
                if ($users->status == 1) {
                    return 'Active';
                } else {
                    return 'Disable';
                }
            })
            ->addColumn('action', function ($users) use ($edit_user_permission) {
                if ($users->status == 1) {
                    $status = 'Disable';
                } else {
                    $status = 'Active';
                }

                if ($edit_user_permission) {
                    $buttons = '<a class="btn btn-info btn-xs" href="' . url("/admin/users/" . $users->id . "/edit") . '"  data-toggle="tooltip" data-placement="left" title="" data-original-title="Update">
                              <i class="fas fa-edit"></i>
                                </a> ';

                    $buttons .= '&nbsp;<button id="change_user_status" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="right" title="' . $status . '" data-original-title="Delete " aria-describedby="tooltip934027">' . $status . '</button>';
                    return $buttons;
                }
            })
            ->removeColumn('first_name', 'last_name')
            ->make(true);
    }


    public function userChangeStatus(Request $request)
    {
        PermissionModel::checkPermission($request, 'EDIT_USER');

        $user_id = $request['user_id'];
        $user = UserModel::find($user_id);

        if ($user != null) {
            if ($user->status == 1) {
                $user->status = 0;
                $status = __('user.labels.disable');
            } else {
                $user->status = 1;
                $status = __('user.labels.active');
            }
            if ($user->save()) {
                return response()->json(['status' => 'success', 'user_status' => $status]);
            }
        }
    }

    public function getTopLevelUsers(Request $request)
    {
        $role_id = $request['user_role'];
        $role = RoleModel::find($role_id);

        $users = $this->roleUsers($role->parent_id);

        return response()->json(['status' => 'success', 'users' => $users]);
    }

    public static function roleUsers($role_id)
    {

        $result = null;

        $result = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->select('users.id', 'username')
            ->where('role_id', $role_id)
            ->where('users.company_id', auth()->user()->company_id)
            ->get();

        return $result;
    }


    public function updatePassword(Request $request)
    {
        parse_str($request['settings_details'], $user_password); //This will convert the string to array

        $validator = Validator::make($user_password, [
            'password' => 'confirmed',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()->all()]);
        }

        $user_id = Auth::user()->id;
        $current_password = $user_password['current_password'];
        $password = $user_password['password'];

        $user = UserModel::find($user_id);
        $hashedpassword = $user->password;
        if (Hash::check($current_password, $hashedpassword)) {
            $user->password = Hash::make($password);
            $user->save();
            return response()->json(['status' => 'success', 'msg' => 'Password Changed Successfully']);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Invalid Password']);
        }
    }


    public function changePasswordView()
    {
        return view('admin::user.password_change');
    }

    public function changeUserTheme()
    {
        $user = UserModel::find(Auth::id());

        if ($user->theme == 'L')
            $user->theme = 'D';
        else
            $user->theme = 'L';

        $user->save();
        return response()->json(['status' => 'success']);

    }
}

?>
