<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // use HasFactory, Notifiable;
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'ND_ten', 'ND_sdt' , 'ND_diaChi' , 'ND_email', 'ND_matKhau'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ND_matKhau'
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
    protected $table = 'nguoiDung';
    protected $primaryKey = 'ND_id';
    public $timestamps = false;
}
