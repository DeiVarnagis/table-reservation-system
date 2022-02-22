<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client_full_name(): string
    {
        return $this->first_name . $this->last_name;
    }

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }
}
