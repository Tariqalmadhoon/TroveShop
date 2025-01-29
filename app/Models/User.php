<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail; //lec 22 - project part 6 - 59:40minutes
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable //implements MustVerifyEmail lec 22 - project part 6 - 59:40minutes
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type'
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
        'password' => 'hashed',
    ];

    function role() {
        return $this->belongsTo(Role::class)->withDefault();
    }

    function image() {
        return $this->morphOne(Image::class, 'imageable');
    }

    function reviews() {
        return $this->HasMany(Review::class);
    }

    function orders() {
        return $this->HasMany(Order::class);
    }

    public function carts(){
        return $this->hasMany(cart::class);
    }
    function order_details() {
        return $this->HasMany(OrderDetail::class);
    }

    function payment() {
        return $this->HasMany(Payment::class);
    }

    function testimonials() {
        return $this->HasMany(Testimonial::class);
    }
}
