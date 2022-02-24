<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Services\TableGenerationService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private TableGenerationService $tableGenerationService;

    public function __construct(TableGenerationService $tableGenerationService)
    {
        $this->tableGenerationService = $tableGenerationService;
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = Restaurant::factory(5)->create();
        foreach ($restaurants as $restaurant)
        {
            $this->tableGenerationService->generateTables($restaurant);
        }
    }
}
