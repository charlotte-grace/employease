<div>
    <h4>My employees <a href="{{ url('employees/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add new</a></h4>
    <ul class="list-group list-group-flush">
        @forelse ($employees as $employee)
            <li class="list-group-item">

                <div class="float-right">
                    <a href='{{ url("employees/{$employee->id}/edit") }}' class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                </div>
                <div>
                    <h5>{{ $employee->title }}</h5>
                    <p>{!! substr(strip_tags($employee->body), 0, 200) !!}</p>
                    <small class="text-muted">Published {{ $employee->created_at }}</small>
                </div>

            </li>
        @empty
            <li>You have not written any employees yet, write one now</li>
        @endforelse

    </ul>
</div>
