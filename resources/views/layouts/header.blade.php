@extends('layouts.app')
@section('body')
<header>
	<nav class="navbar navbar-dark bg-dark navbar-expand-lg border-bottom px-3">
		<div class="container-fluid">
			<a class="navbar-brand" href="{{ route('project.index') }}">Test Manager v2</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button> 
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link" href="{{ route('project.index') }}">Projekty</a>
					</li>
					@if (Auth::user()->hasRoles(['Admin']))
					<li class="nav-item">
						<a class="nav-link" href="{{ route('user.index') }}">Użytkownicy</a>
					</li>
					@endif
				</ul>
				<div class="me-3 text-secondary">
					{{ Auth::user()->email }} | {{ session('team')->name }}
				</div>
				<form action="{{ route('logout') }}" method="POST">
					@csrf
					<button type="submit" class="btn btn-outline-light btn-sm text-decoration-none">Wyloguj</button>
				</form>
			</div>
		</div>
	</nav>
</header>
<main>
    @yield('main')
</main>
@endsection