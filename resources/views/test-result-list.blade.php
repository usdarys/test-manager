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
        <table class="table table-hover bg-light align-middle">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nazwa</th>
                <th scope="col">Wykonawca</th>
                <th scope="col">Data aktualizacji</th>
                <th scope="col">Status</th>
                {{-- <th scope="col"></th> --}}
            </tr>
        </thead>
        <tbody>
        @foreach ($testRun->testCases as $testCase)
            <tr>
                <th scope="row">{{ $testCase->id }}</th>
                <td>
                    <a 
                        href="{{ route('test-result.edit', ['project' => session('project'), 'testRun' => $testRun, 'testCase' => $testCase]) }}" 
                        class="text-decoration-none">{{ $testCase->name }}
                    </a>
                </td>
                <td class="fw-normal text-muted"> -
                    {{-- {if isset($testResult["first_name"]) && isset($testResult["last_name"])}
                        {$testResult["first_name"]} {$testResult["last_name"]}
                    {else}
                        -
                    {/if} --}}
                </td>
                <td class="fw-normal text-muted">
                    @if ($testCase->result->updated_by)
                        {{ $testCase->result->updated_at }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    @switch($testCase->result->status)
                        @case($statusTypes["PASSED"])
                        <span class="badge bg-success">Zaliczony</span>
                            @break
                        @case($statusTypes["FAILED"])
                            <span class="badge bg-danger">Niezaliczony</span>
                            @break
                        @default
                            <span class="badge bg-secondary">Niewykonany</span>
                    @endswitch
                </td>
                <td class="d-flex justify-content-end">
                    <a 
                        href="{{ route('test-result.edit', ['project' => session('project'), 'testRun' => $testRun, 'testCase' => $testCase]) }}" 
                        class="text-decoration-none">>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
@endsection