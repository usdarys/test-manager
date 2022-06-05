@extends('layouts.header')

@section('main')
    <div class="container d-flex justify-content-center credit-calc-form flex-column">
        <h4 class="border-bottom mb-3 mt-4 pb-2">Użytkownicy</h4>
        <x-status/>
        <ul class="nav mt-3 border-bottom pb-3">
            <li class="nav-item">
                <a href="{{ route('user.create') }}" class="btn btn-success">Dodaj</a>
            </li>
            <li>
                <x-search/>
            </li>
        </ul>
        <div id="paginatedList">
            @include('user.list')
        </div>
@endsection