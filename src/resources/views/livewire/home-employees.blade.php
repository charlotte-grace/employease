<div>
    <div class="card">
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @forelse ($employees as $employee)
                    <a href='{{ url("employee/$employee->slug") }}' class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $employee->title }}</h5>
                            <small>{{ $employee->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-1">{!! substr($employee->body, 0, 200) !!}</p>
                        <small>By {{ $employee->author->name }}</small>
                    </a>
                @empty
                    <li class="list-group-item">
                        Sorry, we do not have any employees yet
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
