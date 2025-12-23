@extends('ingredienttypes.page')

@section('content')
    <h1>Ingredient Types</h1>
    <a href="{{ route('ingredienttypes.create') }}">Create New</a>
    <ul>
@foreach($types as $type)
        <li>{{ $type->name }}
            <a href="{{ route('ingredienttypes.edit', $type) }}">Edit</a>
            <form action="{{ route('ingredienttypes.destroy', $type) }}" method="POST" style="display:inline">
@csrf @method('DELETE')
                <button>Delete</button>
            </form>
        </li>
@endforeach
    </ul>
@endsection