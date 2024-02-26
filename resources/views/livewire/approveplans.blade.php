<div class="card bg-gray-100">
    <div class="card-header">
        <h3 class=>Approve Plans</h3>
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
        <section class="m-1 p-2 w-12/12 flex flex-col rounded border p-1 sm:pt-0">
            <h1 class="font-bold text-xl text-center text-green-900">Machines Available</h1>
            @if($machines->count()==0)
            <p class="text-center text-orange-500 mt-2">No Machine Available for Schedule</p>
            @else
            <table class="table">
                <thead class="text-green-900">
                    <th>Machine Name</th>
                    <th>Number Plate</th>
                    <th>Site</th>
                    <th>Milage</th>
                    <th>Schedule Type</th>
                    <th>Prepared By</th>
                    <th>Decision</th>
                </thead>
                @foreach($machines as $machine)
                <tr>
                    <td>{{$machine->machine_name}}</td>
                    <td>{{$machine->number_plate}}</td>
                    <td>{{$machine->site}}</td>
                    <td>{{$machine->worked_hours}}</td>
                    @if($machine->schedule_status)
                    <td>{{$machine->type}}</td>
                    <td>{{$machine->user->name}}</td>
                    @else
                    <td>{{$machine->plan}} Hrs</td>
                    <td class="bg-red-500">Overdue Machine</td>
                    @endif
                    <td><button class="px-2 py-1 text-white font-light tracking-wider bg-green-500 rounded" wire:click="approve({{$machine->id}})">Approve</button>
                        <button class="px-2 py-1 text-white font-light tracking-wider bg-blue-500 rounded" wire:click="comment({{$machine->id}})">Comment</button>
                    </td>
                </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            <div class="mt-2">
                {{$machines->links('pagination')}}
            </div>
        </section>
        @else
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
                <label class="text-sm font-bold text-gray-600">Comment</label>
                <input class="form-control rounded" wire:model="talk" type="text" required="" placeholder="Your Comment">
                @error('talk') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="text-center mt-2">
            <button class="px-2 py-1 text-white font-light tracking-wider bg-green-900 rounded" wire:click="update">Comment</button>
            <button class="px-2 py-1 text-white font-light tracking-wider bg-red-500 rounded" wire:click="cancel">Cancel</button>
        </div>
        @endif
    </div>
</div>