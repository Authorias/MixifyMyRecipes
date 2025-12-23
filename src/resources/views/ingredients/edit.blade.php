@extends('ingredients.page')

@section('content')
<div class="card">
    <div class="card-header bg-warning text-dark">Edit Ingredient</div>
    <div class="card-body">
        <form method="POST" action="{{ route('ingredients.update', $ingredient) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input name="name" type="text" class="form-control" value="{{ $ingredient->name }}" required>
            </div>

            <div class="mb-3">
                <label for="ingredienttypeid" class="form-label">Type</label>
                <select id="ingredienttypeid" name="ingredienttypeid" required>
                @foreach($types as $type)
                    <option value="{{ $type->id }}" {{ $ingredient->ingredienttypeid == $type->id ? 'selected' : '' }}  >{{ $type->name }}</option>
                @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('ingredients.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection