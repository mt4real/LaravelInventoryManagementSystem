<?php
namespace App\Http\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravolt\Avatar\Avatar;

class UserRepository{

    public function getUserImage(){
        $user=User::where(['id'=>Auth::user()->id])->first();
        return asset(config('app.userImage').$user->image);
    }

    public function getUserAvatar(){
        $user=User::where(['id'=>Auth::user()->id])->first();
        $avatar=new Avatar();
        return $avatar->create(ucwords($user->name))->toBase64();
    }
}

