@extends('recipies.page')

@section('content')
    <h1>Create Recipie</h1>
    <form action="{{ route('recipies.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name" required>
        <button type="submit">Save</button>
    </form>
@endsection