<div>
    @include('components.flash-result')
    <div class="flex items-center">
        <livewire:employees.components.count />
        <div class="flex-grow">
            <input type="text" wire:model="search" class="w-full px-4 py-2 rounded-lg shadow focus:border-purple-500 focus:shadow-outline text-white font-bold" placeholder="Search..." style="background-color: #130413; border: solid white;">
        </div>
        <div class="flex-grow-0 ml-4">
            <select wire:model="filterOn" class="w-32 px-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-white font-medium" style="background-color: #130413; border: none;">
                <option value="">Filter By</option>
                <option value="first_name">First Name</option>
                <option value="last_name">Last Name</option>
                <option value="contact_number">Contact Number</option>
            </select>
        </div>
        <div class="flex-grow-1 ml-4">
            <button  wire:click="createEmployee" type="button" class="inline-flex px-4 py-2 sasoft-button">
                + New Employee
            </button>
        </div>
    </div>

    <div class="mt-4 font-bold">
        @if($employees->isEmpty())
            <div class="flex-wrap w-full justify-center">
                <div class="flex w-full justify-center mb-6"><img class="object-fill" src="/icon.jpg"  /></div>
                <div class="flex w-full justify-center mb-10">There is nothing to see here</div>
                <div class="flex w-full justify-center mt-10" style="font-weight: normal;">Create a new employee by clicking the</div>
                <div class="flex w-full justify-center" style="font-weight: normal;"><span class="font-bold">new employee</span>&nbsp;button to get started</div>
            </div>
        @else
            <table class="table-auto border-collapse w-full">
                <thead>
                <tr>
                    <th class="px-4 py-2">First Name</th>
                    <th class="px-4 py-2">Last Name</th>
                    <th class="px-4 py-2">Contact Number</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $key => $employee)
                    <tr class="sasoft-row px-6 text-center">
                        <td class="rounded-l-full px-4 py-2">{{ $employee->first_name }}</td>
                        <td class="px-4 py-2">{{ $employee->last_name }}</td>
                        <td class="px-4 py-2">{{ $employee->contact_number }}</td>
                        <td class="rounded-r-full px-4 py-2">
                            <div class="flex w-full justify-center items-center">
                                <div class="w-1/2 text-center text-2xl" style="padding-right: 10px;">
                                    <a href="{{ route('employees.edit', ['employeeCode' => $employee->code]) }}">&#9998;</a>
                                </div>
                                <div class="w-1/2 text-center text-2xl" style="padding-left: 10px;">
                                    <a href="{{ route('employees.delete', ['employeeCode' => $employee->code]) }}" onclick="return confirm('Really delete this employee?');">&#128465;</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="px-20">
                        <td colspan="4">&nbsp;</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endempty
    </div>
    <div class="mt-4">
        {{ $employees->links() }}
    </div>
</div>
