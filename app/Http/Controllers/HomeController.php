<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Modules\Admin\Http\Controllers\ProductController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard')
            ->with('users', UserModel::count())
            ->with('products_unassigned', ProductModel::where('assign_user',"")->get()->count())
            ->with('products_unassigned_list', ProductModel::where('assign_user',"")->get()->toArray());
    }
}
