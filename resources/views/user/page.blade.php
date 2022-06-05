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
                <div id="search" class="d-flex ms-3">
                    <input id="searchInput" class="form-control me-2" name="search" aria-label="Search" value="">
                    <button id="searchButton" class="btn btn-outline-success btn-sm me-2" type="submit">Szukaj</button>    
                    <button id="clearSearchButton" class="btn btn-outline-danger btn-sm d-none" type="submit">Wyczyść</button>                   
                </div>
            </li>
        </ul>
        <div id="paginationList">
            @include('user.list')
        </div>
        <script>
            window.addEventListener('load', (e) => {
                let search = '';
                const currentUrl = window.location.href.split('?')[0];
                const searchInput = document.getElementById('searchInput');
                const searchButton = document.getElementById('searchButton');
                const clearSearchButton = document.getElementById('clearSearchButton');
                const paginationList = document.getElementById('paginationList');

                paginationList.addEventListener('click', (e) => {
                    let target = event.target;
                    if (target.className === 'page-link' && target.nodeName === 'A') {
                        event.preventDefault();
                        url = target.href;
                        getData(url);
                    }
                });

                clearSearchButton.addEventListener('click', removeSearch);
                searchButton.addEventListener('click', applySearch);
                searchInput.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter') {
                        applySearch();
                    }
                });

                function applySearch() {
                    search = searchInput.value;
                    if (search) {
                        clearSearchButton.classList.remove('d-none');
                        getData(currentUrl);
                    }
                }

                function removeSearch() {
                    search = '';
                    searchInput.value = '';
                    clearSearchButton.classList.add('d-none');
                    getData(currentUrl);
                }

                async function getData(url) {
                    if (search) {
                        if (url.includes('?')) {
                            url += '&search=' + search;
                        } else {
                            url += '?search=' + search;
                        }
                    }

                    const resp = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (resp.ok) {
                        paginationList.innerHTML = await resp.text();
                    }
                }
            });
        </script>
@endsection