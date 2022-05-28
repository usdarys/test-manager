@extends('layouts.header')

@section('main')
    <div class="container d-flex justify-content-center credit-calc-form flex-column">
        <h4 class="border-bottom mb-3 mt-4 pb-2">Użytkownicy</h4>
        <x-status/>
        <ul class="nav mt-3 border-bottom pb-3">
            <li class="nav-item">
                <a href="{{ route('user.create') }}" class="btn btn-success">Dodaj</a>
            </li>
            <li>
                <form class="d-flex ms-3" action="{url action="userList"}" method="POST" >
                    <input class="form-control me-2" type="search" name="search" aria-label="Search" value="{$search}">
                    <button class="btn btn-outline-success btn-sm" type="submit">Szukaj</button>
                </form>
            </li>
        </ul>
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
    </div>
    <x-delete-dialog 
        title='Usunąć użytkownika?'
        body='Operacji nie można cofnąć'
    />
@endsection