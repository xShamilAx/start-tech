<?php

namespace App\Models;

use App\Mail\AccountApproveMail;
use App\Mail\AccountBulkApproveMail;
use App\Mail\AccountRejectMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\admin\Http\Controllers\ConfigController;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $connection = 'mysql';


    public function assigned_user()
    {
        return $this->hasOne('App\Models\UserModel', 'id', 'assign_user_id');
    }

}
