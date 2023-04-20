<div class="container">
    @if ($success)
        <div>
            <div class="alert alert-success">
                Employee has been updated successfully. <a href="{{ url('/home') }}">View all employees</a>
            </div>

        </div>
    @endif

    <form wire:submit.prevent="update({{ $employee->id }})">
        <div class="form-group">
            <label for="Employee title">Employee title</label>
            <input wire:model="employee.title" type="text" name="title" id="title" class="form-control" placeholder="Title of the employee">
            @error('employee.title') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="Employee body">Employee Body</label>
            <textarea name="body" id="body" placeholder="Body of employee here..." wire:model="employee.body" class="form-control"></textarea>
            @error('employee.body') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <button class="btn btn-primary" type="submit">Update</button>
        </div>
    </form>
</div>
