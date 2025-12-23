@extends('recipies.page')

@section('content')
    <h1>Edit Recipie</h1>
    <form action="{{ route('recipies.update', $recipie) }}" method="POST">
        @csrf @method('PUT')
        <input type="text" name="name" value="{{ $recipie->name }}" required>
        <button type="submit">Update</button>
    </form>
@endsection