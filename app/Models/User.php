<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_type',
        'last_name',
        'name',
        'middle_name',
        'phone',
        'phone2',
        'sbk_user_id',
        'email',
        'identifier',
        'organization_name',
        'address',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'ESI_verified_at'=>'datetime',
    ];

    public static function boot()
    {

        parent::boot();

        static::created(function ($user) {
            Log::info('User Created Event:' . $user);
        });

        static::creating(function ($user) {
            // {"user_type":"1","last_name":"\u041a\u0443\u0440\u0431\u0430\u043d\u0431\u0435\u043a \u0443\u0443\u043b\u0443","name":"\u0423\u043b\u0430\u043d\u0431\u0435\u043a","middle_name":null,"phone":"+996771142590","identifier":"77777777777777","email":"testeee333@mail.ru"}
            // {"user_type":"2","organization_name":"TEsttttttt","phone2":"+996771142590","address":"\u0424\u0443\u0447\u0438\u043a\u0430","last_name":"\u0414\u0438\u0440\u0435\u043a\u0442\u043e\u0440","name":"\u0422\u0435\u0441\u0442","middle_name":null,"phone":"+996771142590","identifier":"77777777777773","email":"test.dir@mail.ru"}
            $vtiger = config('vtiger');
            $client = new Client();

            $response = $client->post($vtiger['url'], [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Accept' => 'application/json',
                    'Access-Key' => $vtiger['access_key']
                ],
                'form_params' => $form_params = [
                        'username' => $vtiger['username'],
                        'operation' => 'CreateUsers',
                        'lastname' => $user->last_name,
                        'firstname' => $user->name,
                        'contacts_patronymic' => $user->middle_name,
                        'email' => $user->email,
                    ] + ($user->user_type == 2 ? [
                        'role_type' => 'juridical',
                        'org_name' => $user->organization_name,
                        'inn' => $user->organization_name,
                        'mobile' => $user->phone,
                        'regaddress' => $user->address,
                    ] : [
                        'role_type' => 'individual',
                        'pin' => $user->identifier,
                        'mobile' => $user->phone,
                    ])
            ]);

            if ($response->getStatusCode() != 200) {
                abort(403, __('Unable to create user on server system!'));
            }

            $result = json_decode($response->getBody(), true);

            if (!$result['success']) {
                abort(403, __('Unable to create user on server system!'));
            }

            if (!isset($result['result']['id'])) {
                abort(403, __('Unable to create user on server system!'));
            }

            $user->sbk_user_id = $result['result']['id'];

            Log::info('User Creating Event:' . $user);
        });

    }

    public function logs(): BelongsTo
    {
        return $this->belongsTo(LogActivity::class);
    }

    /**
     * @return HasMany
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
//    protected $appends = ['full_name'];
    public function getFullNameAttribute(): string
    {
        return $this->last_name . ' ' . $this->name . ' ' . $this->middle_name;
    }
}
