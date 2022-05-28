@props(['name' => 'Usuń', 'action' => ''])
<button 
    type="button" 
    class="btn btn-sm btn-outline-danger" 
    data-bs-toggle="modal" 
    data-bs-target="#deleteDialog" 
    onclick="setAction('{{ $action }}')"
>{{ $name }}</button>