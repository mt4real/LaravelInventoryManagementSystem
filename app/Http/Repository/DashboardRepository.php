<?php
namespace App\Http\Repository;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class DashboardRepository{

 public function getNumberOfAdminUsers(){

     $countAdminUsers= User::with('role')->whereHas('role', function($q){
        $q->where('role_name', Role::ADMIN);
    })->count();

    return $countAdminUsers;
 }

  public function getNumberOfActiveAdminUsers(){

    $countActiveAdminUsers= User::with('role')->where('user_status', User::USER_ACTIVE)->whereHas('role', function($q){
        $q->where('role_name', Role::ADMIN);
    })->count();
return $countActiveAdminUsers;
  }
  public function getNumberOfInactiveAdminUsers(){

    $countInactiveAdminUsers= User::with('role')->where('user_status', User::USER_INACTIVE)->whereHas('role', function($q){
        $q->where('role_name', Role::ADMIN);
    })->count();
   return $countInactiveAdminUsers;
  }
  public function getNumberOfSuperAdminUsers(){
    $countSuperAdmins=User::with('role')->whereHas('role', function($q){
        $q->where('role_name', Role::SUPER_ADMIN);
    })->count();
    return $countSuperAdmins;
  }
  public function getNumberOfActiveSuperAdminUsers(){
    $countActiveSuperAdmins=User::with('role')->where('user_status', User::USER_ACTIVE)->whereHas('role', function($q){
        $q->where('role_name', Role::SUPER_ADMIN);
    })->count();
    return $countActiveSuperAdmins;
  }
  public function getNumberOfInactiveSuperAdminUsers(){
    $countInactiveSuperAdmins=User::with('role')->where('user_status', User::USER_INACTIVE)->whereHas('role', function($q){
        $q->where('role_name', Role::SUPER_ADMIN);
    })->count();

    return $countInactiveSuperAdmins;
  }
}

