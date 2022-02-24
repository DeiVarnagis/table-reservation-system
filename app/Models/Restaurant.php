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

    //Get colliding reservation list
    public function getCollidingReservations(Carbon $startDate, Carbon $endDate): Collection
    {
        return $this->reservations()
            ->where(function($query) use ($startDate, $endDate){
                $query->where('start_date', '>', $startDate)
                    ->where('start_date', '<', $endDate);
            })
            ->orWhere(function($query) use ($startDate, $endDate){
                $query->where('end_date', '>', $startDate)
                    ->where('start_date', '<', $endDate);
            })
            ->orWhere(function($query) use ($startDate, $endDate){
                $query->where('start_date', '<', $startDate)
                    ->where('end_date', '>', $endDate);
            })
            ->orWhere(function($query) use ($startDate, $endDate){
                $query->where('start_date', '>', $startDate)
                    ->where('end_date', '<', $endDate);
            })
            ->get();
    }

    //Get amount of free spaces in restaurant
    public function getFreePlaces(Carbon $startDate, Carbon $endDate)
    {
        $takenPlaces = 0;
        foreach ($this->getCollidingReservations($startDate, $endDate) as $reservation) {
            $takenPlaces += $reservation->tables->sum('places');
        }
        return $this->number_of_clients - $takenPlaces;
    }
}
