@extends('layouts.navigation')

@section('content')
    <div class="container d-flex justify-content-center credit-calc-form flex-column">
        <h4 class="border-bottom mb-3 mt-4">{{ $testRun->name }}</h4>
        @if ($testRun->description)
            <p class="p-3 border rounded bg-light">{{ $testRun->description }}</p>
        @endif
        <x-status/>
        <ul class="list-group list-group-flush mb-3 mt-3">
            <li class="list-group-item border-0 d-flex justify-content-center">Wykonane: {{ $stats['tested'] }} / {{ $stats['all'] }}&nbsp;<span class="text-muted">({{ $stats['testedPercent'] }}%)</span></li>       
            <li class="list-group-item border-0 d-flex justify-content-center">Zaliczone: {{ $stats['passed'] }}&nbsp;<span class="text-muted">({{ $stats['passedPercent'] }}%)</span></li>
            <li class="list-group-item border-0 d-flex justify-content-center">Niezaliczone: {{ $stats['failed'] }}&nbsp;<span class="text-muted">({{ $stats['failedPercent'] }}%)</span></li>
        </ul>
        <div class="progress">
            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $stats['passedPercent'] }}%"></div>
            <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $stats['failedPercent'] }}%"></div>
            <div class="progress-bar bg-secondary" role="progressbar" style="width: {{ $stats['untestedPercent'] }}%"></div>
        </div>
        <h6 class="mb-3 mt-5">Przypadki testowe:</h6>
        <div id="paginatedList">
            @include('test-result.list')
        </div>
    </div>
@endsection