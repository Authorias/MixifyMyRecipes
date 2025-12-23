@extends('ingredienttypes.page')

@section('content')
    <h1>Edit Ingredient Type</h1>
    <form action="{{ route('ingredienttypes.update', $ingredientType) }}" method="POST">
        @csrf @method('PUT')
        <input type="text" name="name" value="{{ $ingredientType->name }}" required>
        <button type="submit">Update</button>
    </form>
@endsection