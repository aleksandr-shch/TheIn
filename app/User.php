<?php

declare(strict_types=1);

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 * @package App
 *
 * @property int $id
 * @property string $name
 * @property string email
 * @property string $password
 * @property Carbon|null $email_verified_at
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Organisations relation
     * @return HasMany
     */
    public function organisations(): HasMany
    {
        return $this->hasMany(Organisation::class, 'owner_user_id');
    }
}
