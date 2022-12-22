<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Models\User;
use FontLib\Table\Type\name;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


require __DIR__.'/auth.php';


//index Page route
Route::get('/', [AdminController::class,'indexPageCreate'])->name('index');
Route::post('/', [ AdminController::class,'indexPageStore']);
Route::get('company-welcome',[AdminController::class,'companyWelcome'])->name('companyWelcome');


Route::prefix('backend')->group( function(){
    Route::name('admin.')->group(function () {

        //dashboard  route
    Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard');
        //admin add user route
        Route::get('add-user', [AdminController::class,'addUserCreate'])->name('userReg')
        ->can('addUserCreate', User::class);

        Route::post('add-user', [AdminController::class,'addUserStore'])
        ->can('addUserStore', User::class);

        Route::get('/view-users',[AdminController::class,'viewUsers'])->name('viewUsers')
        ->can('viewUsers', User::class);

        //edit user route
        Route::get('/edit-user/{id}',[AdminController::class,'editUserCreate'])
        ->middleware('signed')
        ->can('editUserCreate', User::class)->name('editUser');
        Route::post('/edit-user/{id}',[AdminController::class,'editUserStore'])
        ->can('editUserStore', User::class);

        //delete user route
        Route::get('/delete-user/{id}',[AdminController::class,'deleteUser'])
        ->name('deleteUser')->can('deleteUser', User::class)->middleware('signed');

        //delete user Image route
        Route::get('/delete-user-image/{id}',[AdminController::class,'deleteUserImage'])
        ->name('deleteUserImage')
       ->can('deleteUserImage', User::class)->middleware('signed');

        //show company route
        Route::get('/view-company',[AdminController::class,'viewCompany'])->name('viewCompany');

        //edit company route
        Route::get('/edit-company/{id}',[AdminController::class,'editCompanyCreate'])
        ->middleware('signed')->name('editCompany')
        ->can('editCompanyCreate', User::class);

        Route::post('/edit-company/{id}',[AdminController::class,'editCompanyStore'])
        ->can('editCompanyStore',User::class);

        //delete company Image route
        Route::get('/delete-company-image/{id}',[AdminController::class,'deleteCompanyImage'])
        ->name('deleteCompanyImage')
        ->can('deleteCompanyImage', User::class)->middleware('signed');

        //supplied product route
        Route::get('add-supplied-product',[AdminController::class,'addSuppliedProductCreate'])
        ->can('addSuppliedProductCreate', User::class)->name('addSuppliedProduct');
        Route::post('add-supplied-product',[AdminController::class,'addSuppliedProductStore'])
        ->can('addSuppliedProductStore', User::class);

        //edit supplied product route
        Route::get('/edit-supplied-product/{id}',[AdminController::class,'editSuppliedProductCreate'])
       ->can('editSuppliedProductCreate', User::class) ->middleware('signed')->name('editSuppliedProduct');

         Route::post('/edit-supplied-product/{id}',[AdminController::class,'editSuppliedProductStore'])
         ->can('editSuppliedProductStore', User::class);

        //view supplied product route
        Route::get('/view-supplied-products',[AdminController::class,'viewSuppliedProducts'])->name('viewSuppliedProducts');

         //add product route
         Route::get('add-product',[AdminController::class,'productCreate'])
         ->name('addProduct')->can('productCreate', User::class);
         Route::post('add-product',[AdminController::class,'productStore'])
         ->can('productStore', User::class);

         //edit product route
         Route::get('/edit-product/{id}',[AdminController::class,'editProductCreate'])
        ->name('editProduct')->can('editProductCreate', User::class)->middleware('signed');

         Route::post('edit-product/{id}',[AdminController::class,'editProductStore'])
         ->can('editProductStore', User::class);

         //view view product route
        Route::get('/view-products',[AdminController::class,'viewProducts'])->name('viewProducts');

        //view archive products route

        Route::get('/view-archived-products',[AdminController::class,'viewArchiveProducts'])
        ->name('viewArchivedProducts');

        //archive product route
        Route::post('/archive-product/{id}',[AdminController::class,'archiveProduct'])
        ->middleware('signed')->name('archivedProduct');

        //archive multiple product route
        Route::post('/archive-product-all',[AdminController::class,"archiveProductAll"])
        ->can('archiveProductAll', User::class)->name('archivedProductAll');

        //update existing product route
        Route::get('/update-existing-product/{id}',[AdminController::class,'updateExistingProductCreate'])
        ->can('updateExistingProductCreate', User::class)->name('existingProduct')->middleware('signed');

        Route::post('/update-existing-product/{id}', [AdminController::class,'updateExistingProductStore'])
        ->can('updateExistingProductStore', User::class);

         //multiple delete product route
         Route::delete('delete-prd',[AdminController::class,'deleteProductPermanentlyAll'])
         ->can('deleteProductPermanentlyAll', User::class)->name('deletePrd');

         //multiple restore product route
         Route::patch('restore-prd',[AdminController::class,'restoreArchivedProductAll'])
        ->can('restoreArchivedProductAll', User::class) ->name('restorePrd');

        //product price route
        Route::get('/change-product-price/{id}',[AdminController::class,'priceEditCreate'])
        ->name('changePrice')->can('priceEditCreate', User::class)->middleware('signed');
        Route::post('/change-product-price/{id}',[AdminController::class,'priceEditStore'])
        ->can('priceEditStore', User::class);

        //view product price route
        Route::get('/view-products-price',[AdminController::class,'viewPrice'])->name('viewPrice');

        //get product price route
        Route::get('get-product-price/{id}',[AdminController::class,'getProductPrice'])->name('getProductPrice');

        //sales product route
        Route::get('/sales-pos',[AdminController::class,'salesPosCreate'])->name('salesPos');
        Route::post('/sales-pos',[AdminController::class,'salesPosStore']);

        //get sales data
        Route::get('/get-sales-data',[AdminController::class,'getSalesPaymentPos'])->name('getSalesPos');

        //view category route
        Route::get('/view-category',[AdminController::class,'viewCategory'])->name('viewCategory');

        //archived supplied product route
        Route::post('archive-supplied-product/{id}',[AdminController::class,'archiveSuppliedProduct'])
        ->middleware('signed')->name('archiveSuppliedProduct');

         //multiple archived supplied product route
         Route::match(['post','get'],'/archive-supplied-prd',[AdminController::class,'archiveSuppliedProductAll'])
         ->name('archiveSuppliedPrd')->can('archiveSuppliedProductAll', User::class);

         //view archived supplied products

         Route::get('/view-archived-supplied-products',[AdminController::class,'viewArchiveSuppliedProducts'])
         ->name('viewArchivedSuppliedProducts');

         //delete supplied product permanently
        Route::post('/delete-supplied-product/{id}',[AdminController::class,'deleteSuppliedProductPermanently'])
        ->middleware('signed')->name('deleteSuppliedProduct');

          //multiple delete supplied product route
         Route::delete('delete-supplied-prd',[AdminController::class,'deleteSuppliedProductPermanentlyAll'])
         ->name('deleteSuppliedPrd')->can('deleteSuppliedProductPermanentlyAll', User::class);

        //multiple restore supplied product route
         Route::patch('/restore-supplied-prd',[AdminController::class,'restoreArchivedProductSuppliedAll'])
        ->can('restoreArchivedProductAll', User::all()) ->name('restoreSuppliedPrd');


        //add category route
        Route::get('add-category',[AdminController::class,'addCategoryCreate'])
        ->can('addCategoryCreate', User::class)->name('addCategory');
        Route::post('add-category',[AdminController::class,'addCategoryStore'])
        ->can('addCategoryStore', User::class);

        //edit category route
        Route::get('/edit-category/{id}',[AdminController::class,'editCategoryCreate'])->name('editCategory')
        ->can('editCategoryCreate', User::class)->middleware('signed');
        Route::post('/edit-category/{id}',[AdminController::class,'editCategoryStore'])
        ->can('editCategoryStore', User::class);

        //delete category
        Route::post('/delete-category/{id}',[AdminController::class,'deleteCategory'])
        ->can('deleteCategory', User::class)->middleware('signed')->name('deleteCategory');

       Route::get('/user-profile',[AdminController::class,'userProfilePageCreate'])->name('userProfile');
        Route::post('/user-profile',[AdminController::class,'userProfilePageStore'])->name('updateUserInfo');

        // Check admin User Current Password
        Route::match(['post', 'get'], 'check-user-pwd', [AdminController::class, 'chkUserPassword'])->name('checkUserPassword');

        //admin change password in the profile page
        Route::post('/backend-change-password', [AdminController::class, 'adminChangePasswordStore'])->name('userChangePassword');

        //update user profile image route
        Route::match(['get','post'],'/update-user-profile-image',[AdminController::class,'userProfileImageUpload'])->name('updateUserProfileImage');

        //admin user image route
        Route::match(['get','post'],'/user-image', [AdminController::class,'userImage'])->name('userImage');

        Route::match(['get','post'], '/user-avatar',[AdminController::class,'userAvatar'])->name('userAvatar');
        // admin user settings route
        Route::get('/user-setting',[AdminController::class,'settings'])->name('settings');

        //sales history report route
        Route::match(['post','get'],'/sales-history-report',[AdminController::class,'salesHistoryReport'])
        ->name('salesHistoryReport');
        Route::match(['post','get'],'/get-sales-history-report',[AdminController::class,'getSalesHistoryReport'])
        ->name('getSalesHistoryReport');

        //archive sales history route
        Route::post('/archive-sales-history-all',[AdminController::class,"archiveSalesHistoryAll"])
        ->can('archiveSalesHistoryAll', User::class)->name('archiveSalesHistoryAll');

        //payments history report route
        Route::match(['post','get'],'/payment-report',[AdminController::class,'paymentsHistoryReport'])
        ->name('paymentsHistoryReport')->can('paymentsHistoryReport', User::class);
        Route::match(['post','get'],'/get-payment-report',[AdminController::class,'getPaymentsHistoryReport'])
        ->name('getPaymentsHistoryReport')->can('getPaymentsHistoryReport', User::class);

        //view payments route
        Route::get('/view-payments', [AdminController::class, 'viewPayments'])
        ->name('viewPayments')->can('viewPayments', User::class);

         //multiple archived payments route
         Route::match(['post','get'],'/archive-payment-all',[AdminController::class,'archivePaymentsAll'])
         ->name('archivePaymentsAll')->can('archivePaymentsAll', User::class);

         //multiple restore supplied product route
         Route::patch('/restore-payments-all',[AdminController::class,'restoreArchivedPaymentsAll'])
        ->can('restoreArchivedPaymentsAll', User::all())->name('restorePaymentAll');

         //multiple delete payment permanently route
         Route::delete('delete-payment',[AdminController::class,'deletePaymentPermanentlyAll'])
         ->can('deletePaymentPermanentlyAll', User::class)->name('deletePayment');

        //product supplied report route
        Route::match(['post','get'],'/supplied-products-report',[AdminController::class,'productsSuppliedReport'])
        ->name('suppliedProductsReport');
        Route::match(['post','get'],'/get-supplied-products-report',[AdminController::class,'getProductsSuppliedReport'])
        ->name('getSuppliedProductsReport');

        //report page route
        Route::get('/report-page',[AdminController::class,'reportPageCreate'])->name('reportPage');

        //get POSpayment route

        Route::match(['post','get'],'/sales-payment', [AdminController::class,'POSPayment'])->name('payment');

        //print receipt route
        Route::get('/print-receipt',[AdminController::class,'printReceipt'])->name('receipt');

        //delete sales
        Route::delete('/delete-sale',[AdminController::class, 'deleteSales'])->name('deleteSales');

        //get sales payment route
        Route::get('/get-sales-payment-data',[AdminController::class,'getSalesPayment'])->name('getSalesPayment');

        //delete sales data route delete-sales-single-data
        Route::delete('delete-sales-data',[AdminController::class,'deleteUserSalesData'])->name('deleteUserSalesData');

        //delete-sales-single-data
        Route::delete('delete-sales-single-data',[AdminController::class,'deleteUserSalesSingleData'])->name('deleteUserSalesSingleData');
    });

});
