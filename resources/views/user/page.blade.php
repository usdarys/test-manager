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
                <div class="d-flex ms-3">
                    <input id="search" class="form-control me-2" type="search" name="search" aria-label="Search" value="">
                    <button id="searchButton" onclick="handleSearch('{{ url()->current() }}')" class="btn btn-outline-success btn-sm" type="submit">Szukaj</button>                    
                </div>
            </li>
        </ul>
        <div id="pagination-list" onclick="handlePagination(event);">
            @include('user.list')
        </div>
        <script>
            async function handleSearch(url) {
                const search = document.getElementById('search').value;
                if (search) {
                    url += '?search=' + search;
                }
                const resp = await fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                if (resp.ok) {
                    document.getElementById('pagination-list').innerHTML = await resp.text();
                }
            }

            async function handlePagination(event) {
                let target = event.target;
                let currentTarget = event.currentTarget;

                if (target.className === 'page-link' && target.nodeName === 'A') {
                    event.preventDefault();
                    const resp = await fetch(target.href, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    if (resp.ok) {
                        currentTarget.innerHTML = await resp.text();
                    }
                } 
            }
        </script>
@endsection