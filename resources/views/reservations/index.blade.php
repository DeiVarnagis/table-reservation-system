@extends('layouts.app')
@section('content')
    <h1>Reservations</h1>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Reservation client</th>
            <th scope="col">Reservation start date</th>
            <th scope="col">Reservation end date</th>
            <th scope="col">Clients amount</th>
            <th scope="col">Created at</th>
            <td><a class="btn btn-outline-primary" href="{{ route('reservations.create') }}" role="button">Create</a></td>
        </tr>
        </thead>
        <tbody>
        @foreach($reservations as $reservation)
            <tr style="cursor: pointer;">
                <th scope="row">{{$reservation->id}}</th>
                <td>{{$reservation->client_full_name()}}</td>
                <td>{{$reservation->start_date}}</td>
                <td>{{$reservation->end_date}}</td>
                <td>{{$reservation->clients->count()}}</td>
                <td>{{$reservation->created_at}}</td>
                <td>
                    <form method="POST" action="{{ route('reservations.destroy', $reservation) }}">
                        @csrf
                        @method('delete')
                        <div class="form-group">
                            <input type="submit" class="btn btn-outline-danger" value="Delete">
                        </div>
                    </form>
                </td>
            </tr>
            <tr>
        @endforeach
        </tbody>
    </table>
@endsection
