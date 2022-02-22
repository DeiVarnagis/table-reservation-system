<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantRequestStore;
use App\Http\Requests\RestaurantRequestUpdate;
use App\Models\Restaurant;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RestaurantController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('restaurants.index',['restaurants' => Restaurant::all()] );
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
     * @param RestaurantRequestStore $request
     * @return RedirectResponse
     */
    public function store(RestaurantRequestStore $request): RedirectResponse
    {
        Restaurant::create($request->validated());
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
     * Show the form for editing the specified resource.
     *
     * @param Restaurant $restaurant
     * @return View
     */
    public function edit(Restaurant $restaurant): View
    {
        return view('restaurants.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RestaurantRequestUpdate $request
     * @param Restaurant $restaurant
     * @return RedirectResponse
     */
    public function update(RestaurantRequestUpdate $request, Restaurant $restaurant): RedirectResponse
    {
        $restaurant->update($request->validated());
        return redirect()->route('restaurants.index')->with(['success' => 'Restaurant successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Restaurant $restaurant
     * @return RedirectResponse
     */
    public function destroy(Restaurant $restaurant) : RedirectResponse
    {
        $restaurant->delete();
        return redirect()->route('restaurants.index')->with(['success' => 'Restaurant successfully deleted']);
    }
}
