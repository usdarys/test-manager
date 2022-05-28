@props(['title' => 'Usunąć element', 'body' => '', 'action' => '', 'confirmButtonName' => 'Usuń', 'cancelButtonName' = 'Anuluj'])

<div class="modal fade" id="deleteDialog" tabindex="-1" aria-labelledby="deleteDialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $title }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>{{ $body }}</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" onclick="setAction('')">{{ $cancelButtonName }}</button>
            <form action="{{ $action }}" method="POST" id="delete_form">
                @csrf 
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">{{ $confirmButtonName }}</button>
            </form>
        </div>
        </div>
    </div>
</div>
<script>
    function setAction(action) {
        document.getElementById('delete_form').action = action;
    }
</script>