@extends('layouts.app')
@section('content')
    <form action="{{ route('restaurants.update', $restaurant) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{old('name', $restaurant->name)}}" placeholder="Enter name">
            @error('name') {{ $message }} @enderror
        </div>
        <div class="form-group">
            <label for="number_of_tables">Table amount</label>
            <input type="number" class="form-control" name="number_of_tables" value="{{old('name', $restaurant->number_of_tables)}}"  placeholder="Enter name">
            @error('number_of_tables') {{ $message }} @enderror
        </div>
        <div class="form-group">
            <label for="maximum_number_of_clients">Client amount</label>
            <input type="number" class="form-control" name="maximum_number_of_clients" value="{{old('name', $restaurant->number_of_clients)}}" placeholder="Enter name">
            @error('number_of_clients') {{ $message }} @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
