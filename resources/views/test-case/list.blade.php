<table class="table table-striped align-middle">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nazwa</th>
            {{-- <th scope="col"></th> --}}
        </tr>
    </thead>
    <tbody>
    @foreach ($testCases as $testCase)
        <tr>
            <th scope="row">{{ $testCase->id }}</th>
            <td>{{ $testCase->name }}</td>
            {{-- <td class="d-flex justify-content-end">
                <a href="{url action="testCaseUpdate" id=$testCase["id"]}" class="btn btn-sm btn-outline-secondary me-2">Edytuj</a>
                <a href="{url action="testCaseDelete" id=$testCase["id"]}" class="btn btn-sm btn-outline-danger">Usuń</a>
            </td> --}}
        </tr>            
    @endforeach
    </tbody>
</table>
{{ $testCases->links() }}