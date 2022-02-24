<?php

namespace App\Services;

use App\Models\Restaurant;
use App\Models\Table;

class TableGenerationService
{
    //Generate tables for restaurant(for testing purposes)
    public function generateTables(Restaurant $restaurant)
    {
        $averagePlaces = floor($restaurant->number_of_clients / $restaurant->number_of_tables);
        $leftOvers = $restaurant->number_of_clients - ($averagePlaces * $restaurant->number_of_tables);
        for ($i = 0; $i < $restaurant->number_of_tables; $i++) {

            $leftOvers > 0 ? $extra = 1 : $extra = 0;

            Table::create([
                'restaurant_id' => $restaurant->id,
                'places' => $averagePlaces + $extra
            ]);
            $leftOvers--;
        }
    }
}
