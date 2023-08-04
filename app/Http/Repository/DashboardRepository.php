<?php
namespace App\Http\Repository;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class DashboardRepository{

 public function getNumberOfAdminUsers(){

     $countAdminUsers= Admin::with('role')->whereHas('role', function($q){
        $q->where('role_name', Role::ADMIN);
    })->count();

    return $countAdminUsers;
 }

  public function getNumberOfActiveAdminUsers(){

    $countActiveAdminUsers= Admin::with('role')->where('user_status', Admin::USER_ACTIVE)->whereHas('role', function($q){
        $q->where('role_name', Role::ADMIN);
    })->count();
return $countActiveAdminUsers;
  }
  public function getNumberOfInactiveAdminUsers(){

    $countInactiveAdminUsers= Admin::with('role')->where('user_status', Admin::USER_INACTIVE)->whereHas('role', function($q){
        $q->where('role_name', Role::ADMIN);
    })->count();
   return $countInactiveAdminUsers;
  }
  public function getNumberOfSuperAdminUsers(){
    $countSuperUsers=Admin::with('role')->whereHas('role', function($q){
        $q->where('role_name', Role::SUPER_ADMIN);
    })->count();
    return $countSuperUsers;
  }
  public function getNumberOfActiveSuperAdminUsers(){
    $countActiveSuperUsers=Admin::with('role')->where('user_status', Admin::USER_ACTIVE)->whereHas('role', function($q){
        $q->where('role_name', Role::SUPER_ADMIN);
    })->count();
    return $countActiveSuperUsers;
  }
  public function getNumberOfInactiveSuperAdminUsers(){
    $countInactiveSuperUsers=Admin::with('role')->where('user_status', Admin::USER_INACTIVE)->whereHas('role', function($q){
        $q->where('role_name', Role::SUPER_ADMIN);
    })->count();

    return $countInactiveSuperUsers;
  }
}

