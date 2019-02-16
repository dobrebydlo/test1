<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'number',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
