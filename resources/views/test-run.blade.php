@extends('layouts.navbar-view')

@section('main')
    <div class="container d-flex justify-content-center credit-calc-form flex-column">
        <h4 class="border-bottom mb-3 mt-3">{if empty($form->id)}Nowy przebieg testów{else}Edycja przebiegu testów{/if}</h4>
        <form action="{{ route('test-run.store') }}"  method="POST" class="mb-3">
            @csrf
            <div class="mb-3">
                <label for="name_id" class="form-label">Nazwa</label>
                <input type="text" class="form-control" id="name_id" name="name" value="{{ old('name') }}">
            </div>
            <div class="mb-4">
                <label for="description_id" class="form-label">Opis</label>
                <textarea class="form-control" id="description_id" rows="3" name="description">{{ old('description') }}</textarea>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="case_include_type" id="all_cases" value="all" onclick="hide()" checked>
                <label class="form-check-label" for="all_cases">
                    Dodaj wszystkie przypadki testowe
                </label>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="case_include_type" id="selected_cases" value="selected" onclick="show()">
                <label class="form-check-label" for="selected_cases">
                    Dodaj wybrane przypadki testowe
                </label>
            </div>

            <ul id="casesList" class="list-group d-none mb-3">
                @foreach ($testCaseList as $testCase)
                    <li class="list-group-item list-group-item-action">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $testCase->id }}" id="{{ $testCase->name }}" name="tc_{{ $testCase->id }}">
                        <label class="form-check-label" for="{{ $testCase->name }}">{{ $testCase->name }}</label>
                    </div>
                    </li>
                @endforeach
            </ul>

            <input type="submit" value="{if empty($form->id)}Dodaj{else}Zapisz{/if} przebieg testów" class="btn btn-success mt-3">
            <a href="{{ route('test-run.index') }}" class="btn btn-outline-danger mt-3">Anuluj</a>
        </form>
        <x-errors/>
    </div>
    <script>
        function show() {
            document.getElementById("casesList").classList.remove("d-none");
        }
        function hide() {
            document.getElementById("casesList").classList.add("d-none");
        }
    </script>
@endsection