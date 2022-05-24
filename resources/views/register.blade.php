@extends('layouts.main')

@section('body')
<main>
	<div class="container d-flex align-items-center login-form">
		<form action="{{ route('register') }}" method="POST" class="w-100">
			@csrf
			<legend class="text-center mb-4">Nowe konto zespołu</legend>
			<fieldset>
				<div class="mb-3">
					<label for="first_name" class="visually-hidden">Imię: </label>
					<input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="imię" class="form-control"/>
				</div>
				<div class="mb-3">
					<label for="last_name" class="visually-hidden">Nazwisko: </label>
					<input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="nazwisko" class="form-control"/>
				</div>
				<div class="mb-3">
					<label for="email" class="visually-hidden">Email: </label>
					<input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="email" class="form-control"/>
				</div>
				<div class="mb-3">
					<label for="team_name" class="visually-hidden">Nazwa zespołu: </label>
					<input id="team_name" type="text" name="team_name" value="{{ old('team_name') }}" placeholder="nazwa zespołu" class="form-control"/>
				</div>
				<div class="mb-3">
					<label for="password" class="visually-hidden">Hasło: </label>
					<input id="password" type="password" name="password" placeholder="hasło" class="form-control"/>
				</div>
				<div class="mb-3">
					<label for="password_confirmation" class="visually-hidden">Potwierdź hasło: </label>
					<input id="password_confirmation" type="password" name="password_confirmation" placeholder="potwierdź hasło" class="form-control"/>
				</div>
			</fieldset>

			<x-errors/>

			<input type="submit" value="Zarejestruj" class="btn btn-success btn-lg w-100 mt-2"/>
		</form>	
	</div>	
</main>
@endsection