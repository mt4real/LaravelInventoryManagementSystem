<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;





class AdminPolicy
{
    use HandlesAuthorization;

    public function __construct(public Admin $admin){

        $this->admin=$admin;
    }

    public function addUserView(){
        return $this->admin->isSuperAdmin();
    }
    public function addUserSave(){
        return $this->admin->isSuperAdmin();
    }

    public function editCategoryCreate(){
        return $this->admin->isSuperAdmin();
    }
    public function editCategoryStore(){
        return $this->admin->isSuperAdmin();
    }

    public function deleteCategory(){
        return $this->admin->isSuperAdmin();
    }

    public function  editCompanyCreate(){
        return $this->admin->isSuperAdmin();
    }
    public function  editCompanyStore(){
        return $this->admin->isSuperAdmin();
    }

    public function deleteCompanyImage(){
        return $this->admin->isSuperAdmin();
    }

    public function deleteUserImage(){
        return $this->admin->isSuperAdmin();
    }
    public function editUserCreate(){

        return $this->admin->isSuperAdmin();
    }

    public function editUserStore(){

        return $this->admin->isSuperAdmin();
    }
    public function deleteUser(){

        return $this->admin->isSuperAdmin();
    }

    public function addSuppliedProductCreate(){

        return $this->admin->isSuperAdmin();
    }

    public function addSuppliedProductStore(){
        return $this->admin->isSuperAdmin();
    }

    public function productCreate(){
        return $this->admin->isSuperAdmin();
    }

    public function productStore(){
        return $this->admin->isSuperAdmin();
    }
    public function updateExistingProductCreate(){
        return $this->admin->isSuperAdmin();
    }

    public function updateExistingProductStore(){
        return $this->admin->isSuperAdmin();
    }
    public function archiveProductAll(){
        return $this->admin->isSuperAdmin();
    }
    public function deleteProductPermanentlyAll(){
        return $this->admin->isSuperAdmin();
    }

    public function restoreArchivedProductAll(){
        return $this->admin->isSuperAdmin();
    }
    public function restoreArchivedProductSuppliedAll(){
        return $this->admin->isSuperAdmin();
    }
    public function editProductCreate(){
        return $this->admin->isSuperAdmin();
    }

    public function editProductStore(){
        return $this->admin->isSuperAdmin();
    }

    public function editSuppliedProductCreate(){
        return $this->admin->isSuperAdmin();
    }
    public function editSuppliedProductStore(){
        return $this->admin->isSuperAdmin();
    }

    public function archiveSuppliedProductAll(){
        return $this->admin->isSuperAdmin();
    }

    public function deleteSuppliedProductPermanentlyAll(){
        return $this->admin->isSuperAdmin();
    }

    public function priceEditCreate(){
        return $this->admin->isSuperAdmin();
    }

    public function priceEditStore(){
        return $this->admin->isSuperAdmin();
    }

    public function salesHistoryReport(){
        return $this->admin->isSuperAdmin();
    }

    public function getSalesHistoryReport(){
        return $this->admin->isSuperAdmin();
    }

    public function productsSuppliedReport(){
        return $this->admin->isSuperAdmin();
    }

    public function getProductsSuppliedReport(){
        return $this->admin->isSuperAdmin();
    }
    public function viewPayments(){
        return $this->admin->isSuperAdmin();
    }

    public function archivePaymentsAll(){
        return $this->admin->isSuperAdmin();
    }

    public function restoreArchivedPaymentsAll(){
        return $this->admin->isSuperAdmin();
    }
    public function deletePaymentPermanentlyAll(){
        return $this->admin->isSuperAdmin();
    }

    public function paymentsHistoryReport(){
        return $this->admin->isSuperAdmin();
    }
    public function getPaymentsHistoryReport(){
        return $this->admin->isSuperAdmin();
    }

    public function archiveSalesHistoryAll(){
        return $this->admin->isSuperAdmin();
    }
    public function viewUsers()
    {
        return $this->admin->isSuperAdmin();
    }





   }
