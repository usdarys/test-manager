@foreach ($projects as $project)
<div class="border-bottom pb-3 pt-3">
    <h5><a href="{{ route('test-run.index', ['project' => $project]) }}" class="text-decoration-none">{{ $project->name }}</a></h5>
    <small>Utworzony: {{ $project->created_at }}</small>
</div>
@endforeach
<div class="mt-3">
    {{ $projects->links() }}
</div>
