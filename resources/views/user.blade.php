@extends('layouts.navbar-view')

@section('main')
    <div class="container d-flex justify-content-center credit-calc-form flex-column">
        <h4 class="border-bottom mb-3 mt-3">Nowy użytkownik</h4>
        <form action="{{ route('user.store') }}"  method="POST" class="mb-3">
            @csrf
            <div class="mb-3">
            <label for="email_id" class="form-label">Email</label>
                <input type="text" class="form-control" id="email_id" name="email" value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label for="first_name_id" class="form-label">Imię</label>
                <input type="text" class="form-control" id="first_name_id" name="first_name" value="{{ old('first_name') }}">
            </div>
            <div class="mb-3">
                <label for="last_name_id" class="form-label">Nazwisko</label>
                <input type="text" class="form-control" id="last_name_id" name="last_name" value="{{ old('last_name') }}">
            </div>
            <div class="mb-3">
                <label for="password_id" class="form-label" aria-describedby="passwordHelp">Hasło</label>
                <input type="password" class="form-control" id="password_id" name="password">
            </div>
            <div class="mb-3">
                <label for="password_confirmation_id" class="form-label" aria-describedby="passwordHelp">Potwierdź hasło: </label>
                <input type="password" class="form-control" id="password_confirmation_id" name="password_confirmation">
            </div>
            <div class="mb-4">
            <div class="mb-1">Rola:</div>
            @foreach ($roles as $role)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $role->id }}" id="{{ $role->name }}" name="role_{{ $role->name }}">
                    <label class="form-check-label" for="{{ $role->name }}">{{ $role->name }}</label>
                </div>    
            @endforeach
            </div>
            <input type="submit" value="Dodaj użytkownika" class="btn btn-success">
            <a href="{{ route('user.index') }}" class="btn btn-outline-danger">Anuluj</a>
        </form>
        <x-errors/>
    </div>
@endsection