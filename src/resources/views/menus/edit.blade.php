@extends('menus.page')

@section('content')
    <h1>Edit Menu</h1>
    <form action="{{ route('menus.update', $menu) }}" method="POST">
        @csrf @method('PUT')
        <input type="text" name="name" value="{{ $menu->name }}" required>
        <button type="submit">Update</button>
    </form>
@endsection