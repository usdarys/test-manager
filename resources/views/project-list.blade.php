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
        {{-- <li>
            <form class="d-flex ms-3" action="{url action="userList"}" method="POST" >
                <input class="form-control me-2" type="search" name="search" aria-label="Search" value="{$search}">
                <button class="btn btn-outline-success btn-sm" type="submit">Szukaj</button>
            </form>
        </li> --}}
    </ul>
    @foreach ($projects as $project)
        <div class="border-bottom pb-3 pt-3">
            <h5><a href="{{ route('test-run.index', ['project' => $project]) }}" class="text-decoration-none">{{ $project->name }}</a></h5>
            <small>Utworzony: {{ $project->created_at }}</small>
        </div>
    @endforeach
</div>
@endsection