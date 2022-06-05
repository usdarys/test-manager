@extends('layouts.header')

@section('main')
<div class="container d-flex justify-content-center credit-calc-form flex-column">
    <h4 class="border-bottom mb-3 mt-4 pb-2">Projekty</h4>
    <x-status/>
    <ul class="nav mt-3 border-bottom pb-3">
        @if (Auth::user()->hasRoles(['Admin']))
        <li class="nav-item">
            <a href="{{ route('project.create') }}" class="btn btn-success">Dodaj</a>
        </li>
        @endif
        <li>
            <x-search/>
        </li>
    </ul>
    <div id="paginatedList">
        @include('project.list')
    </div>
</div>
@endsection