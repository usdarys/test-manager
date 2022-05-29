@extends('layouts.navigation')

@section('content')
<div class="container d-flex justify-content-center credit-calc-form flex-column">
    <h4 class="border-bottom mb-3 mt-4">Przebiegi testów</h4>
    <x-status/>
    <ul class="nav mt-3 border-bottom pb-3">
        <li class="nav-item">
            <a href="{{ route('test-run.create', ['project' => session('project')]) }}" class="btn btn-success">Dodaj</a>
        </li>
        {{-- <li>
            <form class="d-flex ms-3" action="{{ route('test-run.index', ['project' => session('project')]) }}"  method="GET" >
                @csrf
                <input class="form-control me-2" type="search" name="search" aria-label="Search" value="{{ $search }}">
                <button class="btn btn-outline-success btn-sm" type="submit">Szukaj</button>
            </form>
        </li>
        <li>
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
    <table class="table table-hover bg-light align-middle">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nazwa</th>
            <th scope="col">Data utworzenia</th>
            {{-- <th scope="col">Wykonane testy</th> --}}
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($testRuns as $testRun)
        <tr>
            <th scope="row">{{ $testRun->id }}</th>
            <td><a href="{{ route('test-result.index', ['project' => session('project'), 'testRun' => $testRun]) }}" class="text-decoration-none">{{ $testRun->name }}</a></td>
            <td class="fw-normal text-muted">{{ $testRun->created_at }}</td>
            {{-- <td class="fw-normal text-muted">{$testRun["tested"]} / {$testRun["all"]} ({round(($testRun["tested"]*100)/$testRun["all"], 2)}%)</td> --}}
            <td class="d-flex justify-content-end">
                <a href="{{ route('test-result.index', ['project' => session('project'), 'testRun' => $testRun]) }}" class="text-decoration-none">></a>
                {{-- <a href="{url action="testRunUpdate" id=$testRun["id"]}" class="btn btn-sm btn-outline-secondary me-2">Edytuj</a>
                <a href="{url action="testRunDelete" id=$testRun["id"]}" class="btn btn-sm btn-outline-danger">Usuń</a> --}}
            </td>
        </tr>       
    @endforeach
    </tbody>
    </table>
    {{ $testRuns->links() }}
</div>
@endsection