@extends('layouts.navigation')

@section('content')
	<div class="container d-flex justify-content-center credit-calc-form flex-column">
        <h4 class="border-bottom mb-3 mt-4">Przypadki testowe</h4>
        <x-status/>
        <ul class="nav mt-3 border-bottom pb-3">
            <li class="nav-item">
                <a href="{{ route('test-case.create', ['project' => session('project')]) }}" class="btn btn-success me-3">Dodaj</a>
            </li>
            <li>
                <x-search/>
            </li>
        </ul>
        <div id="paginatedList">
            @include('test-case.list')
        </div>
    </div>
@endsection