@extends('layouts.navigation')

@section('content')
    <div class="container d-flex justify-content-center credit-calc-form flex-column">
        <h4 class="border-bottom mb-3 mt-4">{{ $form_title }}</h4>
        <form action="{{ $form_action }}"  method="POST" class="mb-3">
            @csrf
            @if ($testRun->id)
                @method('PATCH')
            @endif
            <div class="mb-3">
                <label for="name_id" class="form-label">Nazwa</label>
                <input type="text" class="form-control" id="name_id" name="name" value="{{ old('name', $testRun->name) }}">
            </div>
            <div class="mb-4">
                <label for="description_id" class="form-label">Opis</label>
                <textarea class="form-control" id="description_id" rows="3" name="description">{{ old('description', $testRun->description) }}</textarea>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="include_type" id="all" value="all" checked>
                <label class="form-check-label" for="all">
                    Dodaj wszystkie przypadki testowe
                </label>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="include_type" id="selected" value="selected">
                <label class="form-check-label" for="selected">
                    Dodaj wybrane przypadki testowe
                </label>
            </div>

            <ul id="casesList" class="list-group d-none mb-3">
                @foreach ($testCases as $testCase)
                    <li class="list-group-item list-group-item-action">
                    <div class="form-check">
                        <input 
                            class="form-check-input" 
                            type="checkbox" 
                            value="{{ $testCase->id }}" 
                            id="tc_{{ $testCase->id}}" 
                            name="tc_{{ $testCase->id }}"
                        >
                        <label class="form-check-label" for="tc_{{ $testCase->id}}" >{{ $testCase->name }}</label>
                    </div>
                    </li>
                @endforeach
                {{-- <div class="mt-3">
                    {{ $testCases->links() }}
                </div> --}}
            </ul>
            <input type="submit" value="{{ $form_button }}" class="btn btn-success mt-3">
            <a href="{{ route('test-run.index', ['project' => session('project')]) }}" class="btn btn-outline-danger mt-3">Anuluj</a>
        </form>
        <x-errors/>
    </div>
@endsection