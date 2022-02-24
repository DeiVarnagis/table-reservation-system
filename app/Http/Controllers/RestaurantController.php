<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantStoreRequest;
use App\Http\Requests\RestaurantUpdateRequest;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Services\TableGenerationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RestaurantController extends Controller
{

    private TableGenerationService $tableGenerationService;

    public function __construct(TableGenerationService $tableGenerationService)
    {
        $this->tableGenerationService = $tableGenerationService;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('restaurants.index', ['restaurants' => Restaurant::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): \Illuminate\View\View
    {
        return view('restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RestaurantStoreRequest $request
     * @return RedirectResponse
     */
    public function store(RestaurantStoreRequest $request): RedirectResponse
    {
        $restaurant = Restaurant::create($request->validated());
        $this->tableGenerationService->generateTables($restaurant);
        return redirect()->route('restaurants.index')->with(['success' => 'Restaurant successfully created']);
    }

    /**
     * Display the specified resource.
     *
     * @param Restaurant $restaurant
     * @return View
     */
    public function show(Restaurant $restaurant): View
    {
        return view('restaurants.show', compact('restaurant'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Restaurant $restaurant
     * @return RedirectResponse
     */
    public function destroy(Restaurant $restaurant): RedirectResponse
    {
        $restaurant->delete();
        return redirect()->route('restaurants.index')->with(['success' => 'Restaurant successfully deleted']);
    }
}
