@extends('ingredienttypes.page')

@section('content')
    <h1>Create Ingredient Type</h1>
    <form action="{{ route('ingredienttypes.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name" required>
        <button type="submit">Save</button>
    </form>
@endsection