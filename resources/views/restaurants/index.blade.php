@extends('layouts.app')
@section('content')
    <h1>Restaurants</h1>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Table amount</th>
            <th scope="col">Client amount</th>
            <th scope="col"><a class="btn btn-outline-primary" href="{{ route('restaurants.create') }}" role="button">Create</a></th>
        </tr>
        </thead>
        <tbody>
    @foreach($restaurants as $restaurant)
            <tr onclick="window.location='{{ route('restaurants.show', $restaurant) }}'" style="cursor: pointer;">
                <th scope="row">{{$restaurant->id}}</th>
                <td>{{$restaurant->name}}</td>
                <td>{{$restaurant->number_of_tables}}</td>
                <td>{{$restaurant->number_of_clients}}</td>
                <td>
                    <form method="POST" action="{{ route('restaurants.destroy', $restaurant) }}">
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
