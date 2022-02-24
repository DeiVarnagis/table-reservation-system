<?php

namespace App\Rules;

use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class CheckRestaurantCapacityRule implements Rule
{
    private string $startDate;
    private int $duration;
    private int $clientsCount;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $startDate, int $duration, int $clientsCount)
    {
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
    public function passes($attribute, $value): bool
    {
        $restaurant = Restaurant::find($value);
        if ($restaurant->getFreePlaces(
                Carbon::make($this->startDate),
                Carbon::make($this->startDate)
                    ->addHour($this->duration)
            ) < $this->clientsCount + 1) {

            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Restaurant is full at that moment';
    }
}
