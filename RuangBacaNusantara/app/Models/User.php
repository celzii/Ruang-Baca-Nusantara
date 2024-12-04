<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use CrudTrait, HasRoles;
    /** @use HasFactory<\Database\Factories\UserFactory> */
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
        'role_id',
        'gender',
        'mobileNumber',
        'address'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */


     public function assignRoles()
     {
        $user = User::find(1);

        // Mendapatkan nama semua role user sebagai array string
        $roles = $user->getRoleNames(); // Output: Collection ['Admin', 'Pegawai']

        // Memeriksa apakah user memiliki role tertentu
        if ($user->hasRole('Admin')) {
            // User memiliki role Admin
        }



     }
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

     public function role()
     {
        return $this->belongsTo(\Spatie\Permission\Models\Role::class, 'role_id');
    }
     
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}

