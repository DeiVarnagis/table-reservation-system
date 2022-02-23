<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client_full_name(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function tables(): BelongsToMany
    {
        return $this->belongsToMany(Table::class)->withTimestamps();
    }

    private function getTakenTables(): array
    {
        $takenTables = [];
        foreach ($this->restaurant->getCollidingReservations(Carbon::make($this->start_date), Carbon::make($this->end_date)) as $reservation) {
            $takenTables = array_merge($takenTables, $reservation->tables->pluck('id')->toArray());
        }
        return $takenTables;
    }

    public function attachTables(int $clients, array $takenTables = []): int
    {
        if (count($takenTables) == 0) {
            $takenTables = $this->getTakenTables();
        }

        if ($clients <= 0) {
            return 1;
        }

        $table = Table::where('restaurant_id', $this->restaurant->id)
            ->whereNotIn('id', $takenTables)
            ->orderBy('places', 'asc')
            ->first();

        $takenTables[] = $table->id;
        $this->tables()->attach($table);
        $clients -= $table->places;

        return $this->attachTables($clients, $takenTables);
    }
}
