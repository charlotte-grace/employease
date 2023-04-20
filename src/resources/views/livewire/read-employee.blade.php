<div>
    <p class="h2">{{ $employee->title }}</p>
    <p class="text-muted">{{ $employee->created_at->toFormattedDateString() }}</p>
    <article>
        {!! $employee->body !!}
    </article>
</div>
