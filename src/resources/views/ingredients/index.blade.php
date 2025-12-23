@extends('ingredients.page')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Ingredienten</h2>

</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-hover table-bordered">
    <thead class="table-dark">
        <tr>
            <th scope="col">Naam</th>
            <th scope="col">Type</th>
            <th scope="col" width="180" class="table-light">
                <a href="{{ route('ingredients.create') }}" class="btn btn-sm" title="Toevoegen">
                    <i class="bi bi-plus-square"></i>
                </a>
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse($ingredients as $ingredient)
            <tr>
                <td>{{ $ingredient->name }}</td>
                <td>{{ $ingredient->ingredientType->name }}</td>
                <td>
                    
                    <a href="{{ route('ingredients.edit', $ingredient) }}" class="btn btn-sm" title="Bewerken">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('ingredients.destroy', $ingredient) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm" onclick="return confirm('Ingredient verwijderen?')" title="Verwijderen">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center">Geen ingredienten gevonden.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
