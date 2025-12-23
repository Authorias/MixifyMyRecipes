@extends('menus.page')

@section('content')
    <h1>Menus</h1>
    <a href="{{ route('menus.create') }}">Create New</a>
    <ul>
@foreach($menus as $menu)
        <li>{{ $menu->name }}
            <a href="{{ route('menus.edit', $menu) }}">Edit</a>
            <form action="{{ route('menus.destroy', $menu) }}" method="POST" style="display:inline">
@csrf @method('DELETE')
                <button>Delete</button>
            </form>
        </li>
@endforeach
    </ul>
@endsection