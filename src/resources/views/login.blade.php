@extends('layouts.app')

@section('title')
Login
@endsection

@section('content')
        <div class="row md-10 justify-content-center login-dialog">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('authenticate') }}">

                        @csrf

                        <div class="row">
                            <div class="col-md-4 col-form-label text-md-end">
                                <label for="name">{{ __('Naam') }}</label>
                            </div>

                            <div class="col-md-8">
                                <input id="name" name="name" class="form-control" value="{{ $name }}" required autofocus>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-form-label">
                                <label for="password" class="text-md-end">{{ __('Wachtwoord') }}</label>
                            </div>

                            <div class="col-md-8">
                                <input id="password" name="password" type="password" class="form-control" required autofocus autocomplete="current-password">
                            </div>
                        </div>

                        @if ($errors->has('password'))
                        <div class="row">
                            <div class="col-md-12 col-form-label">
                                <span class="alert login-alert" role="alert">{{ $errors->first('password') }}</span>
                            </div>
                        </div>
                        @endif
                        
                        <div class="row">
                            <div class="col-md-12 col-form-label text-md-end">
                                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block">{{ __('Inloggen') }}</button>
                            </div>
                        </div>
                    </form>        
                </div>
            </div>
        </div>
@endsection            
