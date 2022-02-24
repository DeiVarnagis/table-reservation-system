<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Http\Requests\RestaurantStoreRequest;
use App\Http\Requests\RestaurantUpdateRequest;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReservationController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('reservations.index', ['reservations' => Reservation::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('reservations.create', ['restaurants' => Restaurant::select(['id', 'name'])->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReservationRequest $request
     * @return JsonResponse
     */
    public function store(ReservationRequest $request): JsonResponse
    {
        //Creating reservation, ignoring duration and clients
        $reservation = Reservation::create(array_merge(
            $request->except(['clients', 'duration']),
            ['end_date' => Carbon::make($request->start_date)->addHour($request->duration)]));

        //Recursively adding tables to reservation
        $reservation->attachTables(count($request->clients) + 1);

        //Creating clients for future development
        foreach ($request->clients as $client) {
            Client::create(array_merge($client, ['reservation_id' => $reservation->id]));
        }

        return response()->json(['message' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param Restaurant $restaurant
     * @return View
     */
    public function show(Restaurant $restaurant): View
    {
        return view('reservations.show', compact('restaurant'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reservation $reservation
     * @return RedirectResponse
     */
    public function destroy(Reservation $reservation): RedirectResponse
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with(['success' => 'Reservation successfully deleted']);
    }

}
