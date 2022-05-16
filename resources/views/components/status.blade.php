@if (session()->has('status'))
    <div class="alert alert-info mb-1">{{ session('status') }}</div>
    {{-- TODO: Dodac mozliwosc zamkniecia statusu --}}
@endif