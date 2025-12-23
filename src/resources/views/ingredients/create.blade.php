@extends('ingredients.page')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">Add Ingredient</div>
    <div class="card-body">
        <form method="POST" action="{{ route('ingredients.store') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input id="name" name="name" type="text" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="ingredienttypeid" class="form-label">Type</label>
                <select id="ingredienttypeid" name="ingredienttypeid" required>
                @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('ingredients.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection