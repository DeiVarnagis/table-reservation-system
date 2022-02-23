<?php

namespace App\Rules;

use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class Reservation implements Rule
{

    private Restaurant $restaurant;
    private string $startDate;
    private int $duration;
    private int $clientsCount;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $restaurantId, string $startDate, int $duration, int $clientsCount)
    {
        $this->restaurant = Restaurant::find($restaurantId);
        $this->startDate = $startDate;
        $this->duration = $duration;
        $this->clientsCount = $clientsCount;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->restaurant->getFreePlaces(Carbon::make($this->startDate), Carbon::make($this->startDate)->addHour($this->duration)) < $this->clientsCount) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->restaurant->name . ' is full at that moment';
    }
}
