@extends('layouts.app')
@section('content')
    <form action="{{ route('restaurants.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter name">
            @error('name') {{ $message }} @enderror
        </div>
        <div class="form-group">
            <label for="number_of_tables">Table amount</label>
            <input type="number" class="form-control" name="number_of_tables" placeholder="Enter amount">
            @error('number_of_tables') {{ $message }} @enderror
        </div>
        <div class="form-group pb-2">
            <label for="number_of_clients">Client amount</label>
            <input type="number" class="form-control" name="number_of_clients" placeholder="Enter amount">
            @error('number_of_clients') {{ $message }} @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
