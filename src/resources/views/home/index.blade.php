@extends('layouts.app')

@section('title')
Home
@endsection

@section('header')
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('ingredients.index') }}">Ingredienten</a>
        <a class="navbar-brand" href="{{ route('ingredienttypes.index') }}">Ingredienten types</a>
    </div>
</nav>
@endsection

@section('content')
<h1>Mixify My Recipes</h1>
@endsection