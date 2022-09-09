<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use App\Models\ConfigModel;
use App\Models\MediaModel;
use App\Models\MediaSortModel;
use App\Models\ODBCModel;
use App\Rules\BranchUniqueValidator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use phpseclib3\File\ASN1\Element;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Models\UserModel;
use Hash;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $page = null)
    {
        return view('admin::product.product_list');
    }

    public function getProductList(Request $request)
    {
        PermissionModel::checkPermission($request, 'MANAGE_PRODUCT');
        $id = auth()->user()->id;
        $user = UserModel::find($id);
        $userRole = $user->getRoleNames();
        if ($userRole[0] == 'Admin')
        $product = ProductModel::with('assigned_user')->get();
        else
            $product = ProductModel::where('assign_user',$id)->with('assigned_user')->get();
        $edit_product_permission = false;
        if (Auth::user()->can('EDIT_PRODUCT')) {
            $edit_product_permission = true;
        }
        $delete_product_permission = false;
        if (Auth::user()->can('DELETE_PRODUCT')) {
            $delete_product_permission = true;
        }

//        return DataTables($product)->make(true);
        return Datatables::of($product)
            ->editColumn('assigned_user', function ($product){
                if (isset($product->assigned_user))
                   return $product->assigned_user->username;
            })
            ->addColumn('action', function ($product) use ($edit_product_permission, $delete_product_permission) {
                $buttons = '';
                if ($edit_product_permission) {
                    $buttons = '<a class="btn btn-info btn-xs" href="' . url("/admin/product/" . $product->id . "/edit") . '"  data-toggle="tooltip" data-placement="left" title="" data-original-title="Update">
                              <i class="fas fa-edit"></i>
                                </a> ';
                }
                if ($delete_product_permission) {
                    $buttons .= '&nbsp;<button id="delete_product" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="right" title="Delele" data-original-title="Delete " aria-describedby="tooltip934027">Delete</button>';

                }
                return $buttons;
            })
            ->rawColumns(['action', 'assigned_user'])
            ->make(true);
    }


    public function create(Request $request)
    {
        return view('admin::product.create_product');
    }


    public function store(Request $request)
    {
        PermissionModel::checkPermission($request, 'ADD_PRODUCT');
        parse_str($request['product_details'], $product_details);

        $validator = Validator::make($product_details, [
            'product_name' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()->all()]);
        }
        $product = ProductModel::find($product_details['product_id']);
        if ($product == null)
        $product = new ProductModel();
        $product->product_name = $product_details['product_name'];
        $product->product_description = $product_details['product_description'];
        $product->product_image_url = $product_details['product_image_url'];

        if (Auth::user()->can('ASSIGN_PRODUCT') || isset($product_details['assign_user']))
        $product->assign_user = $product_details['assign_user'];
        else
            return response()->json(['status' => 'error', 'msg' => 'You Dont Have Permissions to Assign user']);
        $product->save();

        if ($product != FALSE)
            return response()->json(['status' => 'success', 'msg' => 'Updated Successfully']);
        else
            return response()->json(['status' => 'error', 'msg' => 'Something went Wrong']);

    }

    public function show($id)
    {
        //
    }


    public function edit(Request $request, $id)
    {

        PermissionModel::checkPermission($request, 'EDIT_PRODUCT');
        $product = ProductModel::find($id);


        return view('admin::product.create_product')
            ->with('product', $product);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy(Request $request, $id)
    {
        PermissionModel::checkPermission($request, 'DELETE_PRODUCT');
        $product = ProductModel::find($id);

        if ($product->delete()) {
            return '{"status": "success", "msg": "Product is Deleted" , "id" : "' . $id . '"}';
        }
    }

}

?>
