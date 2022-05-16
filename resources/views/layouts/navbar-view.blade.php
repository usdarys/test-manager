@extends('layouts.main')
@section('body')
<nav class="navbar bg-light navbar-light navbar-expand-lg border-bottom mb-3">
	<div class="container-fluid">
		<a class="navbar-brand" href="#">Test Manager v2</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
	  	</button> 
	  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a href="{{ route('test-run.index') }}" class="nav-link">Przebiegi testów</a>
				</li>
				{{-- {if \core\RoleUtils::inRoles(["Admin", "Test Leader"])}  --}}
					<li class="nav-item">
						<a href="{{ route('test-case.index') }}" class="nav-link">Przypadki testowe</a>
					</li>
				{{-- {/if}
				{if \core\RoleUtils::inRole("Admin")}  --}}
					<li class="nav-item">
						{{-- <a class="nav-link" href="{{ route('user.index') }}">Użytkownicy</a> --}}
					</li>
				{{-- {/if} --}}
			</ul>
			<form action="{{ route('logout') }}" method="POST">
				@csrf
				<button type="submit" class="btn btn btn-link text-decoration-none">Wyloguj</button>
			</form>
		</div>
	</div>
</nav>
<main>
    @yield('main')
</main>
@endsection