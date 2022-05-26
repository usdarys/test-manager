@extends('layouts.navigation')

@section('content')
	<div class="container d-flex justify-content-center credit-calc-form flex-column">
        <h4 class="border-bottom mb-3 mt-4">Przypadki testowe</h4>
        <x-status/>
        <ul class="nav mt-3 border-bottom pb-3">
            <li class="nav-item">
                <a href="{{ route('test-case.create') }}" class="btn btn-success">Dodaj</a>
            </li>
            <li>
                <form class="d-flex ms-3" action="{{ route('test-case.index') }}"  method="POST" >
                    <input class="form-control me-2" type="search" name="search" aria-label="Search" value="{$search}">
                    <button class="btn btn-outline-success btn-sm" type="submit">Szukaj</button>
                </form>
            </li>
        </ul>
        <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nazwa</th>
                {{-- <th scope="col"></th> --}}
            </tr>
        </thead>
        <tbody>
        @foreach ($testCaseList as $testCase)
            <tr>
                <th scope="row">{{ $testCase->id }}</th>
                <td>{{ $testCase->name }}</td>
                {{-- <td class="d-flex justify-content-end">
                    <a href="{url action="testCaseUpdate" id=$testCase["id"]}" class="btn btn-sm btn-outline-secondary me-2">Edytuj</a>
                    <a href="{url action="testCaseDelete" id=$testCase["id"]}" class="btn btn-sm btn-outline-danger">Usuń</a>
                </td> --}}
            </tr>            
        @endforeach
        </tbody>
    </table>
    </div>
@endsection