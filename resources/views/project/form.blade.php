@extends('layouts.header')

@section('main')
<div class="container d-flex justify-content-center credit-calc-form flex-column">
    <h4 class="border-bottom mb-3 mt-4 pb-2">{{ $form_title }}</h4>
    <form action="{{ $form_action }}"  method="POST" class="mb-3">
        @csrf
        @if ($project->id)
            @method('PATCH')
        @endif
        <div class="mb-3">
        <label for="name_id" class="form-label">Nazwa</label>
            <input type="text" class="form-control" id="name_id" name="name" value="{{ old('name', $project->name) }}">
        </div>
        <input type="submit" value="{{ $form_button }}" class="btn btn-success">
        <a href="{{ route('project.index') }}" class="btn btn-outline-danger">Anuluj</a>
    </form>
    <x-errors/>
</div>
@endsection