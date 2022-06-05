@extends('layouts.navigation')

@section('content')
<div class="container d-flex justify-content-center credit-calc-form flex-column">
    <h4 class="border-bottom mb-3 mt-4">Przebiegi testów</h4>
    <x-status/>
    <ul class="nav mt-3 border-bottom pb-3">
        <li class="nav-item">
            <a href="{{ route('test-run.create', ['project' => session('project')]) }}" class="btn btn-success me-3">Dodaj</a>
        </li>
        <li>
            <x-search/>
        </li>
        {{-- <li>
            <form class="d-flex ms-3" action="{{ route('test-run.index', ['project' => session('project')]) }}" method="GET" >
            @csrf
            <select class="form-select me-2" id="date_sorter" name="date_sorter">
                <option value="desc" @if (session('date_sorter') == 'desc') selected @endif>od najnowszych</option>
                <option value="asc" @if (session('date_sorter') == 'asc') selected @endif>od najstarszych</option>
            </select>
            <button class="btn btn-outline-success btn-sm" type="submit">Sortuj</button>
            </form>
        </li> --}}
    </ul>
    <div id="paginatedList">
        @include('test-run.list')
    </div>
</div>
@endsection