<?php

namespace App\Models;

use App\Filters\AdminFilters;
use Essa\APIToolKit\Filters\Filterable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * @mixin \Eloquent
 */
class Admin extends Authenticatable implements JWTSubject
{
    use HasFactory, Filterable, Notifiable;

//    protected $default_filters = AdminFilters::class;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
