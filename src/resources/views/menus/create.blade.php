@extends('menus.page')

@section('content')
    <h1>Create Menu</h1>
    <form action="{{ route('menus.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name" required>
        <button type="submit">Save</button>
    </form>
@endsection