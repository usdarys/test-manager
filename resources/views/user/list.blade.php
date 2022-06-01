<table class="table table-striped align-middle mt-1">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Email</th>
            <th scope="col">Imię</th>
            <th scope="col">Nazwisko</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($userList as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->email }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td class="d-flex justify-content-end">
                    <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-sm btn-outline-secondary me-2">Edytuj</a>
                    <x-delete-button action="{{ route('user.destroy', ['user' => $user->id]) }}"/>
                </td>
            </tr>               
        @endforeach
    </tbody>
</table>
{{ $userList->links() }}
</div>
<x-delete-dialog 
    title='Usunąć użytkownika?'
    body='Operacji nie można cofnąć'
/>