@extends('layouts.navigation')

@section('content')
    <div class="container d-flex justify-content-center credit-calc-form flex-column">
        <h4 class="border-bottom mb-3 mt-4">{{ $form_title }}</h4>
        <form action="{{ $form_action }}"  method="POST" class="mb-3">
            @csrf
            @if ($testCase->id)
                @method('PATCH')
            @endif
            <div class="mb-3">
                <label for="name_id" class="form-label">Nazwa</label>
                <input type="text" class="form-control" id="name_id" name="name" value="{{ old('name', $testCase->name) }}">
            </div>
            <div class="mb-3">
                <label for="preconditions_id" class="form-label">Warunki wstepne</label>
                <textarea class="form-control" id="preconditions_id" rows="3" name="preconditions">{{ old('preconditions', $testCase->preconditions) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="steps_id" class="form-label">Kroki</label>
                <textarea class="form-control" id="steps_id" rows="6" name="steps">{{ old('steps', $testCase->steps) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="expected_result_id" class="form-label">Oczekiwany rezultat</label>
                <textarea class="form-control" id="expected_result_id" rows="3" name="expected_result">{{ old('expected_result', $testCase->expected_result) }}</textarea>
            </div>
            <input type="submit" value="{{ $form_button }}" class="btn btn-success">
            <a href="{{ route('test-case.index', ['project' => session('project')]) }}" class="btn btn-outline-danger">Anuluj</a>
        </form>
        <x-errors/>
    </div>
@endsection