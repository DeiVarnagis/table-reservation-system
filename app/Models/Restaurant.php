<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tables(): HasMany
    {
        return $this->hasMany(Table::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function generateTables()
    {
        $averagePlaces = floor($this->number_of_clients / $this->number_of_tables);
        $leftOvers = $this->number_of_clients - ($averagePlaces * $this->number_of_tables);
        for ($i = 0; $i < $this->number_of_tables; $i++) {

            $leftOvers > 0 ? $extra = 1 : $extra = 0;

            Table::create([
                'restaurant_id' => $this->id,
                'places' => $averagePlaces + $extra
            ]);
            $leftOvers--;
        }
    }

    public function getCollidingReservations(Carbon $startDate, Carbon $endDate): Collection
    {
        return $this->reservations()
            ->whereBetween('start_date', [$startDate, $endDate])
            ->orWhereBetween('end_date', [$startDate, $endDate])
            ->get();
    }

    public function getFreePlaces(Carbon $startDate, Carbon $endDate)
    {
        $takenPlaces = 0;
        foreach ($this->getCollidingReservations($startDate, $endDate) as $reservation) {
            $takenPlaces += $reservation->tables->sum('places');
        }
        return $this->number_of_clients - $takenPlaces;
    }
}
