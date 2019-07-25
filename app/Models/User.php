<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Notifications\VerifyEmail;

use Spatie\Permission\Traits\HasRoles;
use Laravel\Cashier\Billable;

use Cmgmyr\Messenger\Traits\Messagable;

use Spatie\Activitylog\Traits\CausesActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use Notifiable, HasRoles, Billable, Messagable, CausesActivity, SoftDeletes;

    protected $guard_name = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password',
    ];

    protected static $logName = 'user';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $logAttributesToIgnore = [ 'last_login_at', 'updated_at'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "User has been {$eventName}";
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'roles' => $this->getRoleNames(),
        ];
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function linkedSocialAccounts()
    {
        return $this->hasMany(LinkedSocialAccount::class);
    }

    public function verifyUser()
    {
        return $this->hasOne(VerifyUser::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function accountant()
    {
        return $this->hasOne(Accountant::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['firstname'] = ucwords($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['lastname'] = ucwords($value);
    }

    public function unreadClientUploadedNotifications($clientID)
    {
        return $this->notifications()->where([
            ['type', 'App\\Notifications\\ClientUploaded'],
            ['data->client_id', $clientID],
            ['read_at', null],
        ]);
    }

    protected $casts = [
        'id' => 'int',
    ];

    protected $appends = ['full_name'];
}
