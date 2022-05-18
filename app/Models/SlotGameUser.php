<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\SlotGameUser
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlotGameUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlotGameUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlotGameUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlotGameUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlotGameUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlotGameUser whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlotGameUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlotGameUser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlotGameUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlotGameUser whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlotGameUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SlotGameUser extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $connection = 'mysql_api';
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        // TODO: Implement getJWTCustomClaims() method.
        return [];
    }
}
