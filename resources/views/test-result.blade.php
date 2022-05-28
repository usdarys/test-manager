@extends('layouts.navigation')

@section('content')
    <div class="container d-flex justify-content-center credit-calc-form flex-column">
        <h4 class="border-bottom mb-3 mt-4">{{ $testCase->name }}</h4>
        <form action="{{ route('test-result.update', ['project' => session('project'), 'testRun' => $testCase->result->test_run_id, 'testCase' => $testCase]) }}"  method="PATCH" class="mb-3">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <h6>Warunki wstepne</h6>
                <p style="white-space: pre-line;" class="p-3 border rounded bg-light">@if ($testCase->preconditions) {{ $testCase->preconditions }} @else - @endif
                </p>
            </div>
            <div class="mb-3">
                <h6>Kroki</h6>
                <p style="white-space: pre-line;" class="p-3 border rounded bg-light">{{ $testCase->steps }}</p>
            </div>
            <div class="mb-3">
                <h6>Oczekiwany rezultat</h6>
                <p style="white-space: pre-line;" class="p-3 border rounded bg-light">{{ $testCase->expected_result }}</p>
            </div>
            <div class="mb-3 w-25">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    @foreach ($statusTypes as $type)
                        <option value={{ $type }} @if ($type == $testCase->result->status) selected @endif>{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="comment_id" class="form-label">Komentarz</label>
                <textarea class="form-control" id="comment_id" rows="3" name="comment">{{ $testCase->result->comment }}</textarea>
            </div>
            <input type="submit" value="Zapisz wynik" class="btn btn-success">
            <a href="{{ route('test-result.index', ['project' => session('project'), 'testRun' => $testCase->result->test_run_id]) }}" class="btn btn-outline-secondary">Wróć</a>
        </form>
        <x-errors/>
    </div>
@endsection