<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'first_name',
        'last_name',
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
     * Apply text string filter to query
     *
     * @param Builder $query
     * @param string $filter optional
     * @return Builder
     */
    public function scopeFilteredBy(Builder $query, string $filter = null)
    {
        if (!empty($filter)) {

            $query

                // Check if normal full name starts with filter string
                ->where('name', 'like', $filter . '%')

                // Check if reverse full name starts with filter string
                ->orWhere('list_name', 'like', $filter . '%')

                // Check if card number starts with filter string
                ->orWhereIn('id', function($query) use (&$filter) {
                    $query
                        ->select('user_id')
                        ->from(with(new Card)->getTable())
                        ->where('number', 'like', $filter . '%')
                    ;
                })
            ;
        }

        return $query;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function addresses()
    {
        return $this->belongsToMany(Address::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function phones()
    {
        return $this->belongsToMany(Phone::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

}
