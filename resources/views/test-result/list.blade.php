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
    @foreach ($testCases as $testCase)
        <tr>
            <th scope="row">{{ $testCase->id }}</th>
            <td>
                <a 
                    href="{{ route('test-result.edit', ['project' => session('project'), 'testRun' => $testRun, 'testCase' => $testCase]) }}" 
                    class="text-decoration-none">{{ $testCase->name }}
                </a>
            </td>
            <td class="fw-normal text-muted">
                @if ($testCase->result->updated_by)
                    {{ $users->find($testCase->result->updated_by)->email }}
                @else
                    -
                @endif
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
{{ $testCases->links() }}