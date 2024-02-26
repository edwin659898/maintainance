<div class="card bg-gray-100">
    <div class="card-header">
        <h3>View Machines</h3>
    </div>
    <div class="card-body">
        <div>
            @if(session()->has('message'))
            <div class="alert alert-success">{{session()->get('message')}}</div>
            @elseif(session()->has('error'))
            <div class="alert alert-danger text-center">{{session()->get('error')}}</div>
            @endif
        </div>
        @if($post == 0)
        <div class="w-full mx-1">
            <input wire:model.debounce.300ms="search" type="text" class="appearance-none block w-1/4 bg-gray-200 text-gray-700 border 
            border-gray-200 rounded py-3 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Search Machine...">
        </div>
        <section class="m-1 p-2 w-12/12 flex flex-col rounded border p-1 sm:pt-0">
            <h1 class="font-bold text-xl text-center text-green-900">Machines Available</h1>
            @if($machines->count()==0)
            <p class="text-center text-orange-500 mt-2">No Machine Available</p>
            @else
            <table class="table">
                <thead class="text-green-900">
                    <th>Machine Name</th>
                    <th>Number Plate</th>
                    <th>Site</th>
                    <th>Milage</th>
                    <th>Upcoming Plan</th>
                    <th>Hours Remaining</th>
                    <th>Scheduled</th>
                    <th>Decision</th>
                </thead>
                @foreach($machines as $machine)
                @if($machine->plan_hours < 2)
                <tr class="bg-red-500">
                    <td>{{$machine->machine_name}}</td>
                    <td>{{$machine->number_plate}}</td>
                    <td>{{$machine->site}}</td>
                    <td>{{$machine->worked_hours}}</td>
                    <td>{{$machine->plan}}</td>
                    <td>{{$machine->plan_hours}}</td>
                    <td>Yes</td>
                    <td><span class="cursor-pointer mr-1 text-blue-500 hover:text-blue-800" wire:click="edit({{$machine->id}})">Edit</span>
                        @if(auth()->user()->can_reset && $machine->schedule_status)
                           <span class="cursor-pointer text-green-500 hover:text-green-800" wire:click="canReset({{$machine->id}})">Reset</span>
                        @endif
                    </td>
                </tr>
                @elseif(($machine->plan/10) > $machine->plan_hours)
                <tr class="bg-yellow-500">
                    <td>{{$machine->machine_name}}</td>
                    <td>{{$machine->number_plate}}</td>
                    <td>{{$machine->site}}</td>
                    <td>{{$machine->worked_hours}}</td>
                    <td>{{$machine->plan}}</td>
                    <td>{{$machine->plan_hours}}</td>
                    @if($machine->schedule_status)
                    <td>Yes</td>
                    @else
                    <td>No</td>
                    @endif
                    <td><span class="cursor-pointer mr-1 text-blue-700" wire:click="edit({{$machine->id}})">Edit</span>
                       @if(auth()->user()->can_reset && $machine->schedule_status)
                        <span class="cursor-pointer text-green-500 hover:text-green-800" wire:click="canReset({{$machine->id}})">Reset</span>
                       @endif
                    </td>
                </tr>
                @else
               
                <tr>
                    <td>{{$machine->machine_name}}</td>
                    <td>{{$machine->number_plate}}</td>
                    <td>{{$machine->site}}</td>
                    <td>{{$machine->worked_hours}}</td>
                    <td>{{$machine->plan}}</td>
                    <td>{{$machine->plan_hours}}</td>
                    @if($machine->schedule_status)
                    <td>Yes</td>
                    @else
                    <td>No</td>
                    @endif
                    <td><span class="cursor-pointer mr-1 text-blue-700" wire:click="edit({{$machine->id}})">Edit</span>
                      @if(auth()->user()->can_reset && $machine->schedule_status)
                        <span class="cursor-pointer text-green-500 hover:text-green-800" wire:click="canReset({{$machine->id}})">Reset</span>
                      @endif
                    </td>
                </tr>


                @endif
                @endforeach
                @endif
                </tbody>
            </table>
            <div class="mt-2">
                {{$machines->links('pagination')}}
            </div>
        </section>
        @else
        <div class="flex justify-between text-gray-700 text-sm">
                <div class="flex ml-1">
                    <span wire:click="back()" class="cursor-pointer" style="line-height: 32px;"><i class="icon-large icon-hand-left"></i> Go back</span>
                </div>
            </div>
            <form wire:submit.prevent="update({{$machine_id}})">
        <div class="flex mt-2">
            <div class="inline-block mt-1 w-1/3 pr-1">
                <input type="hidden" wire:model="machine_id">
                <label class="text-sm font-bold text-gray-600">Machine name</label>
                <input class="form-control rounded bg-gray-500" wire:model="name" type="text" readonly>
            </div>
            <div class="inline-block mt-1 w-1/3 pr-1">
                <label class="text-sm font-bold text-gray-600">Number Plate</label>
                <input class="form-control rounded bg-gray-500" wire:model="plate" type="text" readonly>
            </div>
            <div class="inline-block mt-1 w-1/3 pr-1">
                <label class="text-sm font-bold text-gray-600">Milage</label>
                <input class="form-control rounded" wire:model.lazy="milage" type="text" required="" placeholder="Upcoming plan">
                @error('milage') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="inline-block mt-1 w-1/3 pr-1">
                <label class="text-sm font-bold text-gray-600">Upcoming plan</label>
                <input class="form-control rounded" wire:model.lazy="plan" type="text" required="" placeholder="Upcoming plan">
                @error('plan') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="inline-block mt-1 w-1/3 pr-1">
                <label class="text-sm font-bold text-gray-600">Hours Remaining</label>
                <input class="form-control rounded" wire:model.lazy="hours" type="text" required="" placeholder="Hours Remaining">
                @error('hours') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="text-center mt-2">
            <button class="px-2 py-1 text-white font-light tracking-wider bg-green-900 rounded" type="submit">Update</button>
        </div>
        </form>
        @endif
    </div>
</div>
