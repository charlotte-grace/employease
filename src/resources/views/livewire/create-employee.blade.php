<div class="container">
    @if ($success)
        <div>
            <div class="alert alert-success">
                Employee has been created successfully. <a href="{{ url('/home') }}">View all posts</a>
            </div>

        </div>
    @endif

    <form wire:submit.prevent="create">
        <div class="form-group">
            <label for="Employee title">Employee title</label>
            <input wire:model="title" type="text" name="title" id="title" class="form-control" placeholder="Title of the employee">
            @error('title') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="Employee body">Employee Body</label>
            <textarea name="body" id="body" placeholder="Body of employee here..." wire:model="body" class="form-control"></textarea>
            @error('body') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <button class="btn btn-primary" type="submit">Create Employee</button>
        </div>
    </form>
</div>
