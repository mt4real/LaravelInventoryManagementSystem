<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;




    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public const USER_ACTIVE = "ACTIVE";
    public const USER_INACTIVE = "INACTIVE";

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public static function deleteUserImage()
    {
        // Get Company Image
        $userImage= Admin::where('id', Auth::guard('admin')->user()->id)->first();

        // Get Advert Image Paths
        $large_image_path = config('app.userImage');

        // Delete Large Image if not exists in Folder
        if (file_exists($large_image_path.$userImage->image)) {
            File::delete($large_image_path.$userImage->image);
        }

        }

    public function isSuperAdmin()
    {
        $userType=Admin::with('role')->where(['id'=>Auth::guard('admin')->user()->id])->first();
        if ($userType->role['role_name']===Role::SUPER_ADMIN) {
            return true;
        }
    }

}
