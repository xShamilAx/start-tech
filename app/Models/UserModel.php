<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;

use App\Scopes\BranchScopes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Validator;


class UserModel extends Authenticatable
{
    protected $table = 'users';
    protected $guard_name = 'web';
    protected $connection = 'mysql';
    use Notifiable, HasApiTokens, HasRoles;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'first_name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function addUser($user_details)
    {
        // $role = Role::find($user_details['role']);

        $user = new UserModel();
        $user->username = $user_details['user_name'];
        $user->first_name = $user_details['first_name'];
        $user->last_name = $user_details['last_name'];
        $user->email = $user_details['email'];
        $user->phone_no = $user_details['phone_no'];
        $user->password = Hash::make($user_details['password']);
        $user->status = 1;

        $userid = 0;
            if (isset(auth()->user()->id))
                $userid = auth()->user()->id;
        $user->created_by = $userid;
        $user->updated_by = $userid;
       // $user->branch_id = BranchesModel::getBranchID();

        try {
            $user->save();
            $user->assignRole($user_details['role']);
            return $user;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function updateUser($user_details, $id)
    {

        $role = RoleModel::find($user_details['role']);

        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user = UserModel::find($id);

        $user->username = $user_details['user_name'];
        $user->first_name = $user_details['first_name'];
        $user->last_name = $user_details['last_name'];
        $user->email = $user_details['email'];
        $user->phone_no = $user_details['phone_no'];
        $userid = 0;
            if (isset(auth()->user()->id))
                $userid = auth()->user()->id;
        $user->updated_by = $userid;
        if (!empty($user_details['password'])) {
            $user->password = bcrypt($user_details['password']);
        }
        $user->status = 1;
        try {
            $user->save();
            $user->assignRole($user_details['role']);
            return $user;
        } catch (\Exception $e) {

            return FALSE;
        }
    }

}
