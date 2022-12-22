<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use ErrorException;
use Image;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\CompanyBio;
use App\Models\User;
use App\Models\Role;
use App\Models\Category;
use App\Models\Price;
use App\Models\ProductSupplied;
use App\Models\AddProduct;
use App\Models\Payment;
use App\Models\Sale;
use App\Models\SaleHistory;
use App\Http\Repository\SaleRepository;
use App\Http\Repository\UserRepository;
use App\Http\Repository\PaymentRepository;
use App\Http\Repository\DashboardRepository;
use Exception;


class AdminController extends Controller
{

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->middleware(['auth', 'verified'], ['except' => [
            'indexPageCreate', 'indexPageStore', 'companyWelcome'
        ]]);

        return $this->dashboardRepository=$dashboardRepository;

    }

    public function indexPageCreate()
    {
        if (CompanyBio::count() === 0) {
            return view('admin-welcome');
        }

        return redirect()->route('login');
    }


    public function indexPageStore(Request $request)
    {
        if ($request->ajax()) {
            Validator::make($request->all(), [

                'company_name' => "required|min:2|max:50|regex:/^\w[\w.\-#&\s]*$/",
                'company_email' => ['required', 'string', 'email', 'max:255', 'unique:company_bios'],
                'company_mobile' => "required",
                'company_image' => 'required|mimes:jpeg,png,jpg,gif,bmp,webp|max:20480',

            ])->validate();


            $data = $request->all();
            $company = new CompanyBio();
            $company->company_name = $data['company_name'];
            $company->company_email = $data['company_email'];
            $company->company_mobile = $data['company_mobile'];

            if ($request->hasFile('company_image')) {
                $image_tmp = $request->file('company_image');

                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = config('app.name') . '-' . rand(111, 99999) . '.' . $extension;
                    $large_image_path = config('app.companyImage') . $filename;

                    //save the image
                    Image::make($image_tmp)->save($large_image_path);
                }
            }

            $company->company_image = $filename;
            $company->save();

            return response()->json(['reply' => "companyDataSaved"]);
        }
    }

    public function companyWelcome()
    {
        if (CompanyBio::count() !== 0) {
            return view('company-welcome');
        }

        return redirect()->route('login');
    }

    public function dashboard()
    {
        try {

            $countAdmUsers=$this->dashboardRepository->getNumberOfAdminUsers();
            $countActiveAdmUsers=$this->dashboardRepository->getNumberOfActiveAdminUsers();
            $countInactiveAdmUsers=$this->dashboardRepository->getNumberOfInactiveAdminUsers();
            $countSuperAdmUsers=$this->dashboardRepository->getNumberOfSuperAdminUsers();
            $countActiveSuperAdmUsers=$this->dashboardRepository->getNumberOfActiveSuperAdminUsers();
            $countInactiveSuperAdmUsers=$this->dashboardRepository->getNumberOfInactiveSuperAdminUsers();

            return view('adminAuth.admin-dashboard')->with(compact(
                'countAdmUsers','countActiveAdmUsers','countInactiveAdmUsers','countSuperAdmUsers',
            'countActiveSuperAdmUsers','countInactiveSuperAdmUsers'));
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function editCompanyCreate($id)
    {
        try {
            $edit_company = CompanyBio::where(['id' => $id])->first();
            return view('company.admin-edit-company')->with(compact('edit_company'));
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function editCompanyStore(Request $request, $id)
    {
        $request->validate([

            'company_name' => "required|min:2|max:50|regex:/^\w[\w.\-#&\s]*$/",
            'company_mobile' => [
                "required",
                Rule::unique("company_bios", "company_mobile")->ignore($id)
            ],
            'company_email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique("company_bios", "company_email")->ignore($id)
            ],
            'company_image' => 'image|mimes:jpeg,png,jpg,gif,bmp,webp|max:20480',
        ]);



        try {


            if ($request->isMethod('post')) {
                $data = $request->all();


                //upload image

                if ($request->hasFile('company_image')) {
                    $image_tmp = $request->file('company_image');

                    if ($image_tmp->isValid()) {
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = config('app.name') . '-' . rand(111, 99999) . '.' . $extension;
                        $large_image_path = config('app.companyImage') . $filename;

                        //save the image
                        Image::make($image_tmp)->save($large_image_path);
                    }
                } elseif (!empty($data['current_image'])) {
                    $filename = $data['current_image'];
                } else {
                    $filename = '';
                }


                if (empty($filename)) {
                    return redirect()->back()->with('flash_message_error', "Image is not added");
                }


                CompanyBio::where(['id' => $id])->update([
                    'company_name' => $data['company_name'],
                    'company_mobile' => $data['company_mobile'],
                    'company_email' => $data['company_email'],
                    'company_image' => $filename,
                ]);

                return redirect()->back()->with('flash_message_success', "Company name successfully updated");
            }
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function deleteCompanyImage($id)
    {
        try {


            // Get Company Image
            $companyImage = CompanyBio::where('id', $id)->first();

            // Get Advert Image Paths
            $large_image_path = config('app.companyImage');

            // Delete Large Image if not exists in Folder
            if (file_exists($large_image_path . $companyImage->company_image)) {
                File::delete($large_image_path . $companyImage->company_image);
            }

            // Delete Image from CompanyBio table
            CompanyBio::where(['id' => $id])->update(['company_image' => '']);

            return redirect()->back()->with('flash_message_success', 'Company image has been deleted successfully');
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function viewCompany()
    {
        try {

            $showCompany = CompanyBio::latest()->get();

            return view('company.admin-view-company')->with(compact('showCompany'));
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function addUserCreate()
    {

    try {
        $user_roles = Role::latest()->get();
        return view('user.admin-add-user')->with(compact('user_roles'));
    } catch (ErrorException $ex) {
        return response()->json(['message' => $ex->getMessage()]);
    }

    }

    public function addUserStore(Request $request)
    {
        Validator::make($request->all(), [
            'name' => "required|max:255|regex:/^([a-zA-Z' ]+)$/",
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'required_with:password_confirmation', 'same:password_confirmation', Password::default()],
            'password_confirmation' => ['required', Password::default()],
            'user_image' => 'image|mimes:jpeg,png,jpg,gif,bmp,webp|max:20480',
            'role_id' => "required",
        ], [
            'name.regex' => "This name field can only accept alphabet characters",
            'role_id.required' => "User role field is required",
        ])->validate();

        try {

            if ($request->isMethod('post')) {
                $data = $request->all();
                $user = new User();
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = Hash::make($data['password']);

                if ($request->hasFile('user_image')) {
                    $image_tmp = $request->file('user_image');

                    if ($image_tmp->isValid()) {
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = config('app.name') . '-' . rand(111, 99999) . Carbon::now()->toDateString() . '.' . $extension;
                        $large_image_path = config('app.userImage') . $filename;

                        //save the image
                        Image::make($image_tmp)->save($large_image_path);
                    }
                }
                $user->image = $filename;
                $user->role_id = $data['role_id'];
                $user->save();
                event(new Registered($user));

                return response()->json(['reply' => "Saved"]);
            }
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function deleteUserImage($id)
    {
        try {


            // Get User Image
            $userImage = User::where('id', $id)->first();

            // Get Advert Image Paths
            $large_image_path = config('app.userImage');

            // Delete Large Image if not exists in Folder
            if (file_exists($large_image_path.$userImage->image)) {
                File::delete($large_image_path.$userImage->image);
            }

            // Delete Image from CompanyBio table
            User::where(['id' => $id])->update(['image' => '']);

            return redirect()->back()->with('flash_message_success', 'User image has been deleted successfully');
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }


    public function viewUsers()
    {
        try {

            $admin_users = User::latest()->get();

            return view('user.admin-view-user')->with(compact('admin_users'));
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function editUserCreate($id)
    {
        try {

            $edit_user = User::where(['id' => $id])->first();
            $user_roles = Role::latest()->get();
            return view('user.admin-edit-user')->with(compact('edit_user', 'user_roles'));
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function editUserStore(Request $request, $id)
    {
        $request->validate([

            'name' => "required|max:255|regex:/^([a-zA-Z' ]+)$/",
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique("users", "email")->ignore($id)
            ],
            'user_image' => 'image|mimes:jpeg,png,jpg,gif,bmp,webp|max:20480',
            'role_id' => "required",
        ], [
            'role_id.required' => "User role field is required",
            'name.regex' => "This name field can only accept alphabet characters",
        ]);

        try {

            if ($request->isMethod('post')) {
                $data = $request->all();


                //upload image

                if ($request->hasFile('user_image')) {
                    $image_tmp = $request->file('user_image');

                    if ($image_tmp->isValid()) {
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = config('app.name') . '-' . rand(111, 99999) . Carbon::now()->toDateString() . '.' . $extension;
                        $large_image_path = config('app.userImage') . $filename;

                        //save the image
                        Image::make($image_tmp)->save($large_image_path);
                    }
                } elseif (!empty($data['current_image'])) {
                    $filename = $data['current_image'];
                } else {
                    $filename = '';
                }


                if (empty($filename)) {
                    return redirect()->back()->with('flash_message_error', "Image is not added");
                }


                User::where(['id' => $id])->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'image' => $filename,
                    'role_id' => $data['role_id'],
                    'user_status' => $data['user_status'],
                ]);

                return redirect()->back()->with('flash_message_success', "User details successfully updated");
            }
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }
    public function deleteUser($id)
    {
        try {

            $admin_user = User::where(['id' => $id])->first();

            $large_image_path = config('app.userImage');

            //Delete Image permenently

            //Delete Large image if not exist

            if (file_exists($large_image_path . $admin_user->image)) {
                File::delete($large_image_path . $admin_user->image);
            }

            User::where(['id' => $id])->delete();

            return redirect()->back()->with('flash_message_success', 'User Successfully Deleted');
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function addSuppliedProductCreate()
    {

        return view('supply.admin-add-product-supplied');
    }

    public function addSuppliedProductStore(Request $request)
    {
        Validator::make($request->all(), [
            'company_supplied' => "required|max:255|regex:/^([a-zA-Z' ]+)$/",
            'brand' => "required|max:255|regex:/^([a-zA-Z' ]+)$/",
            'product_supplied' => 'required|regex:/^[\w+\s+]+$/',
            'phone_supplied' => 'required',
            'quantity_supplied' => "required",
            "unit_price" => "required|regex:/^\d{0,8}(\.\d{1,4})?$/",
            'supplied_receipt' => "required|unique:product_supplieds,supplied_receipt|regex:/^[ A-Za-z0-9_@\#&+-]*$/",
            "address_supplied" => "required",

        ])->validate();

        try {

            if ($request->isMethod('post')) {
                $data = $request->all();
                $product_supplied = new ProductSupplied();
                $product_supplied->company_supplied = $data['company_supplied'];
                $product_supplied->brand = $data['brand'];
                $product_supplied->user_id = Auth::user()->id;
                $product_supplied->product_supplied = $data['product_supplied'];
                $product_supplied->phone_supplied = $data['phone_supplied'];
                $product_supplied->quantity_supplied = $data['quantity_supplied'];
                $product_supplied->unit_price = $data['unit_price'];
                $product_supplied->total_amount_supplied = $product_supplied->getTotalSuppliedAmount();
                $product_supplied->supplied_receipt = $data['supplied_receipt'];
                $product_supplied->address_supplied = $data['address_supplied'];
                $product_supplied->save();
                return response()->json(['reply' => "productSuppliedSaved", "totalProductSupplied" => $product_supplied->getTotalSuppliedAmount()]);
            }
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function editSuppliedProductCreate($id)
    {

        try {

            $edit_supplied_product = ProductSupplied::where(['id' => $id])->first();
            return view('supply.admin-edit-product-supplied')->with(compact('edit_supplied_product'));
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }
    public function editSuppliedProductStore(Request $request, $id)
    {

        $request->validate([
            'company_supplied' => "required|max:255|regex:/^([a-zA-Z' ]+)$/",
            'brand' => "required|max:255|regex:/^([a-zA-Z' ]+)$/",
            'product_supplied' => 'required|regex:/^[\w+\s+]+$/',
            'phone_supplied' => 'required',
            'quantity_supplied' => "required",
            "unit_price" => "required|regex:/^\d{0,8}(\.\d{1,4})?$/",
            'supplied_receipt' => "required",
            [
                Rule::unique('product_supplieds', 'supplied_receipt')
            ],
            "regex:/^[ A-Za-z0-9_@\#&+-]*$/",
            "address_supplied" => "required",
        ]);

        try {


            if ($request->isMethod('post')) {
                $data = $request->all();
                $updated_supplied_product = ProductSupplied::find($id);
                $updated_supplied_product->company_supplied = $data['company_supplied'];
                $updated_supplied_product->brand = $data['brand'];
                $updated_supplied_product->product_supplied = $data['product_supplied'];
                $updated_supplied_product->phone_supplied = $data['phone_supplied'];
                $updated_supplied_product->quantity_supplied = $data['quantity_supplied'];
                $updated_supplied_product->unit_price = $data['unit_price'];
                $updated_supplied_product->total_amount_supplied = $updated_supplied_product->getTotalSuppliedAmount();
                $updated_supplied_product->supplied_receipt = $data['supplied_receipt'];
                $updated_supplied_product->address_supplied = $data['address_supplied'];
                $updated_supplied_product->save();
                return redirect()->back()->with('flash_message_success', "Supplied Product is successfully updated and the total amount of the product supplied is {$updated_supplied_product->total_amount_supplied}");
            }
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }
    public function viewSuppliedProducts()
    {
        try {

            $view_supplied_products = ProductSupplied::latest()->get();
            return view('supply.admin-view-supplied-product')->with(compact('view_supplied_products'));
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function archiveSuppliedProductAll(Request $request)
    {
        try {

            $ids = $request->supplied_ids;
            ProductSupplied::whereIn('id', $ids)->delete();
            return redirect()->back()->with('flash_message_success', "You successfully archived the selected supplied product");
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function viewArchiveSuppliedProducts()
    {

        try {

            $archived_suppliedProducts = ProductSupplied::onlyTrashed()->orderBy('deleted_at', 'DESC')->get();
            return view('supply.admin-view-archived-supplied-product')->with(compact('archived_suppliedProducts'));
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function archiveSuppliedProduct($id)
    {

      try {

            ProductSupplied::where(['id' => $id])->delete();
            return redirect()->back()->with('flash_message_success', "Supplied product successfully deleted");
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function deleteSuppliedProductPermanently($id)
    {


        try {

            ProductSupplied::onlyTrashed()->find($id)->forceDelete();
            return redirect()->back()->with('flash_message_success', "record deleted permanently");
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function deleteSuppliedProductPermanentlyAll(Request $request)
    {


       try {

            $ids = $request->ids;
            ProductSupplied::onlyTrashed()->whereIn('id', explode(",", $ids))->forceDelete();
            return response()->json(['status'=>true, 'deleted'=>"Selected Product supplied successfully deleted"]);
           } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function restoreArchivedProductSupplied($id)
    {

        try {

            ProductSupplied::withTrashed()->where(['id' => $id])->restore();
            return redirect()->back()->with('flash_message_success', "Supplied product successfully restored");
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }


    public function restoreArchivedProductSuppliedAll(Request $request)
    {

    try {

    $ids = $request->ids;
    ProductSupplied::withTrashed()->whereIn('id', explode(",",$ids))->restore();
    return response()->json(['status'=>true, 'restored'=>"Selected Product supplied successfully restored"]);

    }
          catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function viewPayments()
    {
        try {

            $view_payments =Payment::latest()->get();
            return view('payment.admin-view-payment-history')->with(compact('view_payments'));
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }


    public function archivePaymentsAll(Request $request)
    {
        try {

            $ids = $request->payment_ids;
            Payment::whereIn('id', $ids)->delete();
            return redirect()->back()->with('flash_message_success', "You successfully archived the selected payment record(s)");
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function restoreArchivedPaymentsAll(Request $request)
    {

    try {

    $ids = $request->ids;
    Payment::withTrashed()->whereIn('id', explode(",",$ids))->restore();
    return response()->json(['status'=>true, 'restored'=>"Selected Payment record(s) successfully restored"]);

    }
          catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }


    public function viewArchivePayments()
    {

        try {

            $archived_payments = Payment::onlyTrashed()->orderBy('deleted_at', 'DESC')->get();
            return view('payment.admin-view-archived-payment-history')->with(compact('archived_payments'));
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function deletePaymentPermanentlyAll(Request $request)
    {


       try {

            $ids = $request->ids;
            Payment::onlyTrashed()->whereIn('id', explode(",", $ids))->forceDelete();
            return response()->json(['status'=>true, 'deleted'=>"Selected Payment record(s) successfully deleted"]);
           } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }



    public function priceEditCreate($id)
    {


        try {

            $edit_categories = Category::get();
            $edit_price = AddProduct::where(['id' => $id])->first();
            return view('price.admin-edit-price')->with(compact(
                'edit_categories',
                'edit_price'
            ));
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function priceEditStore(Request $request, $id)
    {

        $request->validate(
            [
                "sale_price" => "required|regex:/^\d{0,8}(\.\d{1,4})?$/",
            ],
            ['sale_price.required' => "enter the new sales price for this product"]
        );

        try {

            $updated_price = AddProduct::find($id);
            if ($request->isMethod('post')) {
                $data = $request->all();
                $updated_price->sale_price = $data['sale_price'];
                $updated_price->total_amount = $updated_price->getTotalProductAmount();
                $updated_price->save();
                return redirect()->back()->with('flash_message_success', "This product sales price is successfully updated, and the current total amount of this product is  {$updated_price->total_amount}");
            }
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function viewPrice()
    {
        try {

            $price_views = AddProduct::latest()->get();
            return view('price.admin-view-price')->with(compact('price_views'));
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }
    public function productCreate()
    {

        try {

            $categories = Category::latest()->get();
            return view('product.admin-add-product')->with(compact('categories'));
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function productStore(Request $request)
    {
        Validator::make($request->all(), [
            'category_id' => "required",
            'product_name' => "required|regex:/^[\w+\s+]+$/|unique:add_products",
            'product_defect' => "sometimes|nullable|regex:/^\d{0,8}(\.\d{1,4})?$/",
            'product_quantity' => "required|regex:/^\d{0,8}(\.\d{1,4})?$/",
            'sale_price' => "required|regex:/^\d{0,8}(\.\d{1,4})?$/",

        ], [
            'category_id.required' => "category name is required",
            'product_name.unique' => "this product is already exist you can only update the quantity or check your product archive to restore",
            'product_defect.regex' => "please enter a valid product defect amount",
        ])->validate();
        $data = $request->all();
        $product = new AddProduct();

        try {


            if ($request->isMethod('post')) {



                $product->user_id = Auth::user()->id;
                $product->category_id = $data['category_id'];
                $product->product_name = $data['product_name'];
                $product->product_defect = $data['product_defect'];
                if (!empty($data['product_defect'])) {
                    $product->product_quantity = $data['product_quantity'] - $data['product_defect'];
                } else {
                    $product->product_quantity = $data['product_quantity'];
                }
                $product->sale_price = $data['sale_price'];
                $product->total_amount = $product->getTotalProductAmount();

                if (!isset($product_sessionId)) {
                    $product_sessionId = Str::random(30);
                    Session::put('product_sessionId', $product_sessionId);
                }
                $product->product_sessionId =$product_sessionId;
                $product->save();
                return response()->json(['reply' => "productSaved", "totalProductAmount" => $product->getTotalProductAmount()]);
            }
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function editProductCreate($id)
    {

        try {

            $edit_product = AddProduct::where(['id' => $id])->first();
            $edit_categories = Category::get();
            return view('product.admin-edit-product')->with(compact('edit_product', 'edit_categories'));
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }
    public function editProductStore(Request $request, $id)
    {

        $request->validate([
            'category_id' => "required",
            'product_name' => [
                'required', 'regex:/^[\w+\s+]+$/',
                Rule::unique('add_products', 'product_name')->ignore($id)
            ],
            'product_defect' => "sometimes|nullable|regex:/^\d{0,8}(\.\d{1,4})?$/",

            'product_quantity' => "required|regex:/^\d{0,8}(\.\d{1,4})?$/",
        ], [
            'category_id.required' => "category name is required",
            'product_name.unique' => "this product is already exist you can only update the quantity",
            'product_defect.regex' => "please enter a valid product defect amount",
        ]);
        $updated_product = AddProduct::find($id);
        try {


            if ($request->isMethod('post')) {
                $data = $request->all();

                $updated_product->category_id = $data['category_id'];
                $updated_product->product_name = $data['product_name'];
                $updated_product->product_defect = $data['product_defect'];
                if (!empty($data['product_defect'])) {
                    $updated_product->product_quantity = $data['product_quantity'] - $data['product_defect'];
                } else {
                    $updated_product->product_quantity = $data['product_quantity'];
                }

                $updated_product->total_amount = $updated_product->getTotalProductAmount();
                $updated_product->save();
                return redirect()->back()->with('flash_message_success', "Product is successfully updated and the total amount of the product in the stock is {$updated_product->total_amount}");
            }
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function viewProducts()
    {

        try {

            $view_products = AddProduct::latest()->get();
            return view('product.admin-view-product')->with(compact('view_products'));
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function archiveProduct($id)
    {

        try {

            AddProduct::where(['id' => $id])->delete();
            return redirect()->back()->with('flash_message_success', "Product is successfully deleted");
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function updateExistingProductCreate($id)
    {

        try {


            $edit_categories = Category::get();
            $updateExisting_product = AddProduct::where(['id' => $id])->first();
            return view('product.admin-update-existing-product')->with(compact('updateExisting_product', 'edit_categories'));
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }
    public function updateExistingProductStore(Request $request, $id)
    {

        $request->validate([

            'product_quantity' => "required|regex:/^\d{0,8}(\.\d{1,4})?$/",
        ]);
        $updated_product = AddProduct::find($id);
        try {


            if ($request->isMethod('post')) {
                $data = $request->all();

                $updated_product->product_quantity += $data['product_quantity'];
                $updated_product->total_amount = $updated_product->getTotalProductAmount();
                $updated_product->save();
                return redirect()->back()->with('flash_message_success', "The existing product is successfully updated, and the total amount of the product in the stock is {$updated_product->total_amount}");
            }
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function archiveProductAll(Request $request)
    {
        try {

            $ids = $request->product_ids;
            AddProduct::whereIn('id', $ids)->delete();
            return redirect()->back()->with('flash_message_success', "You successfully archived the selected product(s)");
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function viewArchiveProducts()
    {

        try {

            $archived_products = AddProduct::onlyTrashed()->orderBy('deleted_at', 'DESC')->get();
            return view('product.admin-view-archived-products')->with(compact('archived_products'));
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }


    public function deleteProductPermanently($id)
    {


        try {

            AddProduct::onlyTrashed()->find($id)->forceDelete();
            return redirect()->back()->with('flash_message_success', "product deleted permanently");
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }


    public function deleteProductPermanentlyAll(Request $request)
    {

        try {

            $ids = $request->ids;
            AddProduct::onlyTrashed()->whereIn('id', explode(",",$ids))->forceDelete();
            return response()->json(['status' => true, 'productDelete' => "Selected product(s) deleted successfully"]);
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function restoreArchivedProduct($id)
    {

        try {

            AddProduct::withTrashed()->where(['id' => $id])->restore();
            return redirect()->back()->with('flash_message_success', "Product successfully restored");
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }


    public function restoreArchivedProductAll(Request $request)
    {

        try {

            $ids = $request->ids;
            AddProduct::withTrashed()->whereIn('id', explode(",", $ids))->restore();
            return response()->json(['status' => true, 'productRestore' => "Selected product(s) deleted successfully"]);
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }


    public function addCategoryCreate()
    {

        return view('category.admin-add-category');
    }

    public function addCategoryStore(Request $request)
    {



        try {
    if ($request->ajax()) {
        Validator::make($request->all(), [

            'category_name' => "required|max:255|regex:/^([a-zA-Z' ]+)$/|unique:categories,category_name",

        ])->validate();


        $data = $request->all();
        $category = new Category();
        $category->category_name = $data['category_name'];
        $category->save();

        return response()->json(['reply' => "categoryDataSaved"]);
    }
}
        catch(ErrorException $ex){

            return response()->json(['message'=>$ex->getMessage()]);
        }
    }
    public function editCategoryCreate($id)
    {
        try {


            $edit_category = Category::where(['id' => $id])->first();
            return view('category.admin-edit-category')->with(compact('edit_category'));
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }
    public function editCategoryStore(Request $request, $id)
    {

        $request->validate([

            'category_name' => "required|max:255|regex:/^([a-zA-Z' ]+)$/",
            [
                Rule::unique('categories', 'category_name')->ignore($id)

            ],
        ]);

        try {


            if ($request->isMethod('post')) {
                $data = $request->all();
                $category = Category::findOrFail($id);
                $category->category_name = $data['category_name'];
                $category->save();
                return redirect()->back()->with('flash_message_success', "Category successfully updated");
            }
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }
    public function viewCategory()
    {

        try {


            $view_categories = Category::latest()->get();
            return view('category.admin-view-categories')->with(compact('view_categories'));
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function deleteCategory($id)
    {
        try {


            Category::where(['id' => $id])->delete();
            return redirect()->back()->with('flash_message_success', "Category successfully deleted");
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function userProfilePageCreate()
    {


        return view('user.admin-user-profile');
    }
    public function userProfilePageStore(Request $request)
    {

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user_normal_id = User::firstOrFail();

        Validator::make(
            $request->all(),
            [

                'name' => "required|min:2|max:255|regex:/^([a-zA-Z' ]+)$/",

                'email' => [
                    'required', 'string', 'email', 'max:255',
                    Rule::unique('users', 'email')->ignore($user_id),
                ],

                'phone' => [
                    'required',
                    Rule::unique('users', 'phone')->ignore($user_id),
                ],

            ],
            [
                'name.regex' => "The name field can only accept alphabet characters"
            ]
        )->validate();


        try {


            if ($user_normal_id->id !== Auth::user()->id) {

                return response()->json(['owner' => "userNotFound"], 403);
            }
            if ($request->isMethod('post')) {

                $data = $request->all();
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->phone = $data['phone'];
                $user->save();
                return response()->json(['reply' => "Saved"]);
            } else {
                return response()->json(['noReply' => "notSaved"]);
            }
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function salesPosCreate()
    {
        try {

            $product_names = AddProduct::get();
            $sales_pos=Sale::where(['user_id'=>Auth::user()->id])->get();
            return view('sales.admin-sales-pos')->with(compact('product_names','sales_pos'));
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function getSalesPaymentPos(){
        $saleRepository=new SaleRepository();
        $getPaymentSalesData=new PaymentRepository();
        $sales_pos=$saleRepository->getSales();
        $company_name=CompanyBio::first();
        return response()->json(['salesData'=>$sales_pos,
        'grandTotal'=>$saleRepository->getUserSalesAmount(),
        "companyBio"=>$company_name->company_name,'paymentData'=>$getPaymentSalesData->getUserSalesPayment()]);
    }

    public function salesPosStore(Request $request)
    {

        Validator::make($request->all(), [
            'product_id' => "required",
            'product_quantity' => "required|regex:/^\d{0,8}(\.\d{1,4})?$/",
            'sale_price' => "required|regex:/^\d{0,8}(\.\d{1,4})?$/",
        ],

        ['product_id.required'=>"the product field is required",

        ])->validate();

try {
    if ($request->isMethod('post')) {
        $data=$request->all();
        $user_id = Auth::user()->id;
        $session_id = Session::get('session_id');
        $saleRepository=new SaleRepository();

        $product= AddProduct::where(['id' => $data['product_id']])->first();

        $check_duplicateProduct_adding = Sale::where(['addProduct_id' => $data['product_id'], 'user_id' => $user_id, 'session_id' => $session_id])->count();
        $sales_product = new Sale();
        $sales_history = new SaleHistory();

        //   add to sales history table
        if ($product->product_quantity < $data['product_quantity']) {
            return response()->json(['lowQuantity' => "The required quantity is not available"]);
        }

        if ($product->product_status===AddProduct::PRODUCT_INACTIVE) {
            return response()->json(['productInactive' => "The required product is inactive"]);
        }
        if ($check_duplicateProduct_adding > 0) {
            return response()->json(['duplicateProduct' => "This product is already been added, you can only increase the quantity"]);
        }

        if (!isset($session_id)) {
            $session_id = Str::random(40);
            Session::put('session_id', $session_id);
        } else {
            $quantity_remain=$product->product_quantity-$data['product_quantity'];

            $sales_history->user_id = $user_id;
            $sales_history->addProduct_id = $data['product_id'];
            $sales_history->quantity_sales = $data['product_quantity'];
            $sales_history->quantity_remain = $quantity_remain;
            $sales_history->sales_price = $data['sale_price'];
            $sales_history->total_amount= $sales_history->getTotalSalesHistoryProductAmount();
            $sales_history->save();

            //deduct from the AddProduct table
            $product->product_quantity -= $data['product_quantity'] ?? '';
            $product->total_amount=$product->getTotalProductAmount();
            $product->save();

            //add product sales to sales table
            $sales_product->user_id = $user_id;
            $sales_product->addProduct_id = $data['product_id'];
            $sales_product->price = $data['sale_price'];
            $sales_product->quantity = $data['product_quantity'] ?? '';
            $sales_product->total = $sales_product->getTotalSalesProductAmount();
            $sales_product->session_id = $session_id;
            $sales_product->save();

            $sales_pos=$saleRepository->getSales();

            return response()->json(['salesData'=>$sales_pos,'grandTotal'=>$saleRepository->getUserSalesAmount()]);

            }
        }
        }

        catch(ErrorException $ex){
            return response()->json(['message'=>$ex->getMessage()]);
        }
    }

    public function POSPayment(Request $request){

        Validator::make($request->all(), [
            'customer_name' => "required|max:255|regex:/^([a-zA-Z' ]+)$/",
            'payment_type'=>"required",
            'paid_amount'=>"required|regex:/^\d{0,8}(\.\d{1,4})?$/",

        ])->validate();
        $getPaymentSalesData=new PaymentRepository();

    try{
        if ($request->isMethod('post')) {
    $data=$request->all();
    $saleRepository=new SaleRepository();
    $payment=new Payment();

    if ($data['paid_amount']<$saleRepository->getUserSalesAmount()) {
        return response()->json(['invalidAmount'=>"The amount is invalid"]);
    }
    if($getPaymentSalesData->getUserSalesPayment()){
        return response()->json(['doublePayment'=>"This payment has already been made"]);
    }
    else {
        $payment->user_id=Auth::user()->id;
        $payment->customer_name=$data['customer_name'];
        $payment->paid_amount=$data['paid_amount'];
        $payment->sales_amount=$saleRepository->getUserSalesAmount();
        $payment->change_amount=$data['paid_amount']-$saleRepository->getUserSalesAmount();
        $payment->payment_type=$data['payment_type'];
        $payment->payment_session=Str::random(20);

        $payment->save();
        if (!isset($sales_sessionId)) {
            $sales_sessionId =$payment->id;
            Session::put('sales_sessionId', $sales_sessionId);
        }
        return response()->json(['paymentData'=>$payment]);
        }
        }

       }
        catch(ErrorException $ex){
            return response()->json(['message'=>$ex->getMessage()]);
        }

            }

    public function getSalesPayment(){

        $getPaymentSalesData=new PaymentRepository();
        try{
            return response()->json(['getPaymentData'=>$getPaymentSalesData->getUserSalesPayment()]);

        }
        catch(ErrorException $ex){
            return response()->json(['message'=>$ex->getMessage()]);
            }

        }



    public function deleteUserSalesData(Request $request)
    {


       try {

            $ids = Auth::user()->id;
            Sale::whereIn('user_id', explode(",", $ids))->delete();
            return response()->json(['status'=>true, 'deleted'=>"Selected Payment record(s) successfully deleted"]);
           } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function deleteUserSalesSingleData(Request $request)
    {


       try {

            $id= $request->id;
            Sale::where(['id'=>$id])->delete();
            return response()->json(['status'=>true, 'deleted'=>"Sales record(s) successfully deleted"]);
           } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }


    public function printReceipt(){

        $company_name=CompanyBio::first();
        return view('receipt.receipt')->with(compact('company_name'));
    }

    public function getProductPrice(Request $request)
    {

        try{
            $product_price = AddProduct::select('sale_price', 'id')->where(['id' => $request->id])->first();
        return response()->json(['sales' => $product_price]);

        }
        catch(ErrorException $ex){
            return response()->json(['message'=>$ex->getMessage()]);
        }

    }

    public function chkUserPassword(Request $request)
    {

        try {

            $data = $request->all();
            $current_password = $data['current_password'];
            $user_id = Auth::user()->id;
            $check_password = User::where('id', $user_id)->first();
            if ($reply = Hash::check($current_password, $check_password->password)) {

                return response()->json(['reply' => 'Success'], 200);
            } else {

                return response()->json(['noReply' => "Failure"]);
            }
        } catch (ErrorException $e) {


            return response()->json([
                'status' => "failed",
                'message' => $e->getMessage()
            ]);
        }
    }



    public function adminChangePasswordStore(Request $request)
    {

        Validator::make($request->all(), [
            'current_password' => "required",
            'new_password' => ['required', 'required_with:confirmation_password', 'same:confirmation_password', Password::default()],
            'confirmation_password' => ['required', Password::default()],

        ])->validate();


        try {


            $user_normal_id = User::firstOrFail();

            if ($user_normal_id->id !== Auth::user()->id) {

                return response()->json(['userNotFound' => "Unable to perform this operation"], 403);
            }

            if ($request->isMethod('post')) {
                $data = $request->all();
                $old_pwd = User::where('id', Auth::user()->id)->first();
                $current_password = $data['current_password'];
                //compare current password with old password
                if (Hash::check($current_password, $old_pwd->password)) {
                    $new_password = Hash::make($data['new_password']);
                    // Update password if the old password is correct
                    User::where('id', Auth::user()->id)->update(['password' => $new_password]);
                    return response()->json(['reply' => "Saved"]);
                } else {

                    return response()->json(['noReply' => "notSaved"]);
                }
            }
        } catch (ErrorException $e) {

            return response()->json(['message' => $e->getMessage()]);
        }
    }


    public function userAvatar(Request $request){

        $userRepository=new UserRepository();
    if ($request->isMethod('post')) {
    $data=$request->all();
    if (!empty(Auth::user()->image)) {
        User::deleteUserImage();
       }
       User::where(['id' => Auth::user()->id])->update([
        'image' => "",
    ]);
    return response()->json(['userProfileAvatar'=>$userRepository->getUserAvatar()]);
    }
    }
    public function userImage(){
        try{
            $userRepository=new UserRepository();
      if (!empty(Auth::user()->image)) {
    return response()->json(['userImg'=>$userRepository->getUserImage()]);
         }
            else{

                return response()->json(['userAvatar'=>$userRepository->getUserAvatar()]);
            }
        }
        catch (ErrorException $e) {

            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function userProfileImageUpload(Request $request)
    {

        Validator::make($request->all(), [
            'image' => 'required|mimes:jpeg,png,jpg,gif,bmp,webp|max:20480',
        ])->validate();

        $userRepository=new UserRepository();

        try {
            if ($request->isMethod('post')) {

                //upload image
                if ($request->hasFile('image')) {
                    User::deleteUserImage();
                    $image_tmp = $request->file('image');
                    if ($image_tmp->isValid()) {
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = config('app.name') . '-' . rand(111, 99999) . '.' . $extension;
                        $large_image_path = config('app.userImage') . $filename;

                        //save the image
                        Image::make($image_tmp)->save($large_image_path);
                    }
                }



                User::where(['id' => Auth::user()->id])->update([
                    'image' => $filename ?? '',
                ]);

                return response()->json(['reply' => "UpdateImage", 'updatedImg' => $userRepository->getUserImage()]);
            }
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function settings(){
        try{

            return view('settings.admin-user-setting');

        }
        catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }
    public function viewSalesHistory()
    {
        try {

            $view_salesHistory =SaleHistory::latest()->get();
            return view('sales.admin-view-sales-history')->with(compact('view_salesHistory'));
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }


    public function salesHistoryReport(){

    try {
        $salesHistoryReport=SaleHistory::latest()->get();
        return view('sales.admin-view-sales-history-report-page')->with(compact('salesHistoryReport'));
    }
    catch (ErrorException $ex) {
        return response()->json(['message' => $ex->getMessage()]);
    }
        }

    public function getSalesHistoryReport(Request $request){
    $request->validate([
        'start_date'=>"required|nullable|date",
        'end_date'=>"required|nullable|date"
    ]);

    try {
        if ($request->start_date || $request->end_date) {
            $salesHistoryReport=SaleHistory::createdBetweenDates([$request->start_date, $request->end_date])->get();

        }
        else{

            $salesHistoryReport=SaleHistory::latest()->get();
        }

        return view('sales.admin-view-sales-history-report-page')->with(compact('salesHistoryReport'));
      }

       catch (ErrorException $ex) {
        return response()->json(['message' => $ex->getMessage()]);
    }


    }

    public function archiveSalesHistoryAll(Request $request)
    {
        try {

            $ids = $request->salesHistory_ids;
            SaleHistory::whereIn('id', $ids)->delete();
            return redirect()->back()->with('flash_message_success', "You successfully archived the selected sales record(s)");
        } catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function paymentsHistoryReport(){

        try{

            $paymentsHistoryReport=Payment::latest()->get();
            return view('payment.admin-view-payment-report')->with(compact('paymentsHistoryReport'));

        }

        catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }

           }

    public function getPaymentsHistoryReport(Request $request){
    $request->validate([
        'start_date'=>"required|nullable|date",
        'end_date'=>"required|nullable|date"
    ]);

    try {
        if ($request->start_date || $request->end_date) {
            $paymentsHistoryReport=Payment::createdBetweenDates([$request->start_date, $request->end_date])->get();

        }
        else{
            $paymentsHistoryReport=Payment::latest()->get();
        }

        return view('payment.admin-view-payment-report')->with(compact('paymentsHistoryReport'));

      }

       catch (ErrorException $ex) {
        return response()->json(['message' => $ex->getMessage()]);
    }


    }



    public function productsSuppliedReport(){
        try{
            $productsSuppliedReport=ProductSupplied::latest()->get();
            return view('supply.admin-view-product-supplied-report-page')->with(compact('productsSuppliedReport'));

        }

        catch (ErrorException $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
        }

    public function getProductsSuppliedReport(Request $request){
    $request->validate([
        'start_date'=>"required|nullable|date",
        'end_date'=>"required|nullable|date"
    ]);

    try {
        if ($request->start_date || $request->end_date) {
            $productsSuppliedReport=ProductSupplied::createdBetweenDates([$request->start_date, $request->end_date])->get();

        }
        else{
            $productsSuppliedReport=ProductSupplied::latest()->get();
        }
        return view('supply.admin-view-product-supplied-report-page')->with(compact('productsSuppliedReport'));

      }

       catch (ErrorException $ex) {
        return response()->json(['message' => $ex->getMessage()]);
    }


    }

      public function reportPageCreate(){

        return view('report.admin-view-report-page');
    }


}

