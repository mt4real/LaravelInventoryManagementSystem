<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    public User $user;

    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct($user)
    {
           $this->user=$user;
    }

    public function viewUsers()
    {
        return $this->user->isSuperAdmin();
    }

    public function addUserCreate()
    {
        return $this->user->isSuperAdmin();
    }
    public function addUserStore(){
        return $this->user->isSuperAdmin();
    }
    public function deleteUser(){
        return $this->user->isSuperAdmin();
    }


    public function addCategoryCreate(){
        return $this->user->isSuperAdmin();
    }
    public function addCategoryStore(){
        return $this->user->isSuperAdmin();
    }

    public function editCategoryCreate(){
        return $this->user->isSuperAdmin();
    }
    public function editCategoryStore(){
        return $this->user->isSuperAdmin();
    }

    public function deleteCategory(){
        return $this->user->isSuperAdmin();
    }

    public function  editCompanyCreate(){
        return $this->user->isSuperAdmin();
    }
    public function  editCompanyStore(){
        return $this->user->isSuperAdmin();
    }

    public function deleteCompanyImage(){
        return $this->user->isSuperAdmin();
    }

    public function deleteUserImage(){
        return $this->user->isSuperAdmin();
    }
    public function editUserCreate(){

        return $this->user->isSuperAdmin();
    }

    public function editUserStore(){

        return $this->user->isSuperAdmin();
    }

    public function addSuppliedProductCreate(){

        return $this->user->isSuperAdmin();
    }

    public function addSuppliedProductStore(){
        return $this->user->isSuperAdmin();
    }

    public function productCreate(){
        return $this->user->isSuperAdmin();
    }

    public function productStore(){
        return $this->user->isSuperAdmin();
    }
    public function updateExistingProductCreate(){
        return $this->user->isSuperAdmin();
    }

    public function updateExistingProductStore(){
        return $this->user->isSuperAdmin();
    }
    public function archiveProductAll(){
        return $this->user->isSuperAdmin();
    }
    public function deleteProductPermanentlyAll(){
        return $this->user->isSuperAdmin();
    }

    public function restoreArchivedProductAll(){
        return $this->user->isSuperAdmin();
    }
    public function editProductCreate(){
        return $this->user->isSuperAdmin();
    }

    public function editProductStore(){
        return $this->user->isSuperAdmin();
    }

    public function editSuppliedProductCreate(){
        return $this->user->isSuperAdmin();
    }
    public function editSuppliedProductStore(){
        return $this->user->isSuperAdmin();
    }

    public function archiveSuppliedProductAll(){
        return $this->user->isSuperAdmin();
    }

    public function deleteSuppliedProductPermanentlyAll(){
        return $this->user->isSuperAdmin();
    }

    public function priceEditCreate(){
        return $this->user->isSuperAdmin();
    }

    public function priceEditStore(){
        return $this->user->isSuperAdmin();
    }

    public function salesHistoryReport(){
        return $this->user->isSuperAdmin();
    }

    public function getSalesHistoryReport(){
        return $this->user->isSuperAdmin();
    }

    public function productsSuppliedReport(){
        return $this->user->isSuperAdmin();
    }

    public function getProductsSuppliedReport(){
        return $this->user->isSuperAdmin();
    }
    public function viewPayments(){
        return $this->user->isSuperAdmin();
    }

    public function archivePaymentsAll(){
        return $this->user->isSuperAdmin();
    }

    public function restoreArchivedPaymentsAll(){
        return $this->user->isSuperAdmin();
    }
    public function deletePaymentPermanentlyAll(){
        return $this->user->isSuperAdmin();
    }

    public function paymentsHistoryReport(){
        return $this->user->isSuperAdmin();
    }
    public function getPaymentsHistoryReport(){
        return $this->user->isSuperAdmin();
    }

    public function archiveSalesHistoryAll(){
        return $this->user->isSuperAdmin();
    }
}
