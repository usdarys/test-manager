<table class="table table-hover bg-light align-middle">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nazwa</th>
            <th scope="col">Data utworzenia</th>
            {{-- <th scope="col">Wykonane testy</th> --}}
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($testRuns as $testRun)
        <tr>
            <th scope="row">{{ $testRun->id }}</th>
            <td><a href="{{ route('test-result.index', ['project' => session('project'), 'testRun' => $testRun]) }}" class="text-decoration-none">{{ $testRun->name }}</a></td>
            <td class="fw-normal text-muted">{{ $testRun->created_at }}</td>
            {{-- <td class="fw-normal text-muted">{$testRun["tested"]} / {$testRun["all"]} ({round(($testRun["tested"]*100)/$testRun["all"], 2)}%)</td> --}}
            <td class="d-flex justify-content-end">
                <a href="{{ route('test-result.index', ['project' => session('project'), 'testRun' => $testRun]) }}" class="text-decoration-none">></a>
                {{-- <a href="{url action="testRunUpdate" id=$testRun["id"]}" class="btn btn-sm btn-outline-secondary me-2">Edytuj</a>
                <a href="{url action="testRunDelete" id=$testRun["id"]}" class="btn btn-sm btn-outline-danger">Usuń</a> --}}
            </td>
        </tr>       
    @endforeach
    </tbody>
</table>
{{ $testRuns->links() }}