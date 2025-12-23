@extends('recipies.page')

@section('content')
    <h1>Menus</h1>
    <a href="{{ route('recipies.create') }}">Create New</a>
    <ul>
@foreach($recipies as $recipie)
        <li>{{ $recipie->name }}
            <a href="{{ route('recipies.edit', $recipie) }}">Edit</a>
            <form action="{{ route('recipies.destroy', $recipie) }}" method="POST" style="display:inline">
@csrf @method('DELETE')
                <button>Delete</button>
            </form>
        </li>
@endforeach
    </ul>
@endsection