@extends('layouts.main')

@section('body')
<main>
	<div class="container d-flex align-items-center login-form">
		<form action="{{ route('login') }}" method="POST" class="w-100">
			@csrf
			<legend class="text-center mb-4">Test Manager</legend>
			<fieldset>
				<div class="mb-3">
					<label for="email" class="visually-hidden">Email: </label>
					<input id="email" type="text" name="email" value="" placeholder="email" class="form-control"/>
				</div>
				<div class="mb-3">
					<label for="password" class="visually-hidden">Hasło: </label>
					<input id="password" type="password" name="password" placeholder="hasło" class="form-control"/>
				</div>
			</fieldset>

			@if ($errors->any())
				@foreach ($errors->all() as $error)
					<div class="alert alert-danger mb-1">{{ $error }}</div>
				@endforeach
			@endif

			{{-- {if $msgs->isInfo()}
				{foreach $msgs->getInfos() as $msg}
					<div class="alert alert-info mb-1">{$msg->text}</div>
				{/foreach}
			{/if} --}}

			<input type="submit" value="Zaloguj" class="btn btn-success btn-lg w-100 mt-2"/>
		</form>	
	</div>	
</main>
@endsection
