<div class="card bg-gray-100">
    <div class="card-header">
        <h3>Maintainance Checklists</h3>
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
            border-gray-200 rounded py-3 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"placeholder="Search Checklist...">
        </div>
        <section class="m-1 p-2 w-12/12 flex flex-col rounded border p-1 sm:pt-0">
            <h1 class="font-bold text-xl text-center text-green-900">Available Checklists</h1>
            @if($comments->count()==0)
            <p class="text-center text-orange-500 mt-2">No available Checklists</p>
            @else
            <table class="table">
                <thead class="text-green-900">
                    <tr>
                        <th>Machine Name</th>
                        <th>Checklist Name</th>
                        <th>Items</th>
                    </tr>
                </thead>
                @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->machine_name}}</td>
                    <td>{{$comment->hours}}</td>
                    <td><a href="#" wire:click="details({{$comment->id}})">View</a></td>
                    </td>
                </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            <div class="mt-2">
                {{$comments->links()}}
            </div>
        </section>
        @endif

        @if($post == 1)
        <div class="flex justify-between text-gray-700 text-sm">
          <div class="flex ml-1">
            <span wire:click="back()" class="cursor-pointer" style="line-height: 32px;"><i class="icon-large icon-hand-left"></i> Go back</span>
          </div>
          <div class="text-xs mr-1">
          <button class="px-2 py-1 text-white font-light tracking-wider bg-blue-500 rounded" wire:click="addlist({{$machine_id}})">Add</button>       
          </div>
        </div>
        <section class="m-1 p-2 w-full border rounded">
            <div class="rounded border py-3">
                <h5 class="text-blue-700 font-bold ml-1">
                    {{$name}}
                </h5>
                <div class="flex justify-between text-gray-700 text-sm">
                    <div class="flex ml-1">
                        <p class="text-red-500 font-bold">
                            {{$hour}}
                        </p>
                    </div>
                </div>
                @foreach($lists as $list)
                <div class="flex justify-between text-gray-700 text-sm">
                    <div class="flex ml-1">
                        <p>
                            {{$list->checklist}}
                        </p>
                    </div>
                    <div class="text-xs mr-1">
                        <p class="cursor-pointer text-red-700">
                            <i onclick="confirm('Are you sure of Deleting?') || event.stopImmediatePropagation()" wire:click="delete({{$list->id}})" class="icon-large icon-remove"></i></p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        @if($post == 2)
        <div class="flex justify-between text-gray-700 text-sm">
          <div class="flex ml-1">
            <span wire:click="back()" class="cursor-pointer" style="line-height: 32px;"><i class="icon-large icon-hand-left"></i> Go back</span>
          </div>
        </div>
        <section class="m-1 p-2 w-full border rounded">
            <div class="rounded border py-3">
                <h5 class="text-blue-700 font-bold ml-1">
                    {{$name}}
                </h5>
                <div class="flex justify-between text-gray-700 text-sm">
                    <div class="flex ml-1">
                        <p class="text-red-500 font-bold">
                            {{$hour}}
                        </p>
                    </div>
                </div>
                
                <div class="form-group">
                            <fieldset>
                                <h5 class="mt-2 ml-1">Items to check</h5>
                                <small id="choicesHelp" class="form-text text-muted ml-1">Give your items to check on this specific Maintainance Name</small>
                                <div class="mt-2">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div>
                                                <div class="input-group  ml-1">
                                                    <form wire:submit.prevent="newlist({{$machine_id}})">
                                                    <div>
                                                    <input wire:model.lazy="list" type="text" class="form-control" placeholder="Enter item">
                                                    </div>
                                                    <div class="mt-2">
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </fieldset>
                        </div>

            </div>
        </section>
        @endif

    </div>
</div>



