@extends('layouts.navbar-view')

@section('main')
    <div class="container d-flex justify-content-center credit-calc-form flex-column">
        <h4 class="border-bottom mb-3 mt-3">{if empty($form->id)}Nowy przypadek testowy{else}Edycja przypadku testowego{/if}</h4>
        <form action="{{ route('test-case.store') }}"  method="POST" class="mb-3">
            @csrf
            <input type="hidden" name="id" value="{$form->id}">
            <div class="mb-3">
                <label for="name_id" class="form-label">Nazwa</label>
                <input type="text" class="form-control" id="name_id" name="name" value="{$form->name}">
            </div>
            <div class="mb-3">
                <label for="preconditions_id" class="form-label">Warunki wstepne</label>
                <textarea class="form-control" id="preconditions_id" rows="3" name="preconditions">{$form->preconditions}</textarea>
            </div>
            <div class="mb-3">
                <label for="steps_id" class="form-label">Kroki</label>
                <textarea class="form-control" id="steps_id" rows="6" name="steps">{$form->steps}</textarea>
            </div>
            <div class="mb-3">
                <label for="expected_result_id" class="form-label">Oczekiwany rezultat</label>
                <textarea class="form-control" id="expected_result_id" rows="3" name="expected_result">{$form->expectedResult}</textarea>
            </div>
            <input type="submit" value="{if empty($form->id)}Dodaj{else}Zapisz{/if} przypadek testowy" class="btn btn-success">
            <a href="{{ route('test-case.index') }}" class="btn btn-outline-danger">Anuluj</a>
        </form>
        <x-errors/>
    </div>
@endsection