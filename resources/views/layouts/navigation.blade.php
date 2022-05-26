@extends('layouts.header')
@section('main')
<div class='bg-light pt-3 px-3'>
    <h5 class="ms-3 mb-3">
        <small class="text-success">{{ session('team')->name }}</small>
         / 
        <small class="text-success">{{ $project->name }}</small>
    </h5>
    <nav>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('test-run.index', ['project' => $project]) }}">Przebiegi testów</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('test-case.index', ['project' => $project]) }}">Przypadki testowe</a>
            </li>
        </ul>
    </nav>
</div>
@yield('content')
@endsection