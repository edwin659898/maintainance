<div class="card bg-gray-100">
    <div class="card-header">
        <h3>Reports</h3>
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
            border-gray-200 rounded py-3 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Search Report...">
        </div>
        <section class="m-1 p-2 w-12/12 flex flex-col rounded border p-1 sm:pt-0">
            <h1 class="font-bold text-xl text-center text-green-900">Received Reports</h1>
            @if($comments->count()==0)
            <p class="text-center text-orange-500 mt-2">No available Report</p>
            @else
            <table class="table">
                <thead class="text-green-900">
                    <tr>
                        <th>Date Prepared</th>
                        <th>Prepared By</th>
                        <th>Site</th>
                        <th>Machine Name</th>
                        <th>Number Plate</th>
                        <th>Checklist Type</th>
                        <th>Status</th>
                        <th>Details</th>
                    </tr>
                </thead>
                @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->date}}</td>
                    <td>{{$comment->owner}}</td>
                    <td>{{$comment->site}}</td>
                    <td>{{$comment->machine_name}}</td>
                    <td>{{$comment->number_plate}}</td>
                    <td>{{$comment->type}}</td>
                    <td>{{$comment->status}}</td>
                    <td>
                        <p class="cursor-pointer text-blue-500" wire:click="details({{$comment->id}})">View</p>
                    </td>
                </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            <div class="mt-2">
                {{$comments->links('pagination')}}
            </div>
        </section>
        @endif

        @if($post == 1)
        <form wire:submit.prevent="update({{$report_id}})">
            <div class="flex justify-between text-gray-700 text-sm">
                <div class="flex ml-1">
                    <span wire:click="back()" class="cursor-pointer" style="line-height: 32px;"><i class="icon-large icon-hand-left"></i> Go back</span>
                </div>
            </div>
            <h3 class="text-center text-xl font-semibold">{{$name}} {{$type}}</h3>
            <div class="flex">
                <div class="inline-block mt-1 w-1/3 pr-1">
                    <label class="text-sm font-bold text-gray-600">Site</label>
                    <input class="form-control rounded bg-gray-600" readonly wire:model="site">
                </div>
                <div class="inline-block mt-1 w-1/3 pr-1">
                    <label class="text-sm font-bold text-gray-600">Machine Name</label>
                    <input class="form-control rounded bg-gray-600" readonly wire:model="name">
                </div>
                <div class="inline-block mt-1 w-1/3 pr-1">
                    <label class="text-sm font-bold text-gray-600">Number Plate</label>
                    <input class="form-control rounded bg-gray-600" readonly wire:model="plate">
                </div>
            </div>

            <section class="mt-2 px-3 py-3 w-full border rounded">
                <div class="flex justify-between font-semibold uppercase">
                    <span class="w-7/12 ...">Title</span>
                    <span class="w-2/12 ...">Check</span>
                    <span class="w-3/12 ...">Comment</span>
                </div>
                @foreach($lists as $list)
                <div class="flex justify-between text-gray-700 text-sm">
                    <span class="w-7/12">{{$list->item}}</span>
                    <span class="w-2/12">{{$list->answer}}</span>
                    <span class="w-3/12">{{$list->comment}}</span>
                </div>
                @endforeach

            </section>
            <div class="flex">
                <div class="inline-block mt-1 w-1/3 pr-1">
                    @if($this->type == 'Daily' || $this->type == 'Weekly')
                    <label class="text-sm font-bold text-gray-600">Milage</label>
                    <input class="w-full bg-gray-200 form-control rounded" readonly wire:model="milage" />
                    @else
                    <label class="text-sm font-bold text-gray-600">Next Maintainance</label>
                    <input class="w-full bg-gray-200 form-control rounded" readonly wire:model="plan" />
                    @endif
                    <input type="hidden" readonly wire:model="plan_hours" />
                </div>
                <div class="inline-block mt-1 w-1/3 pr-1">
                    <label class="text-sm font-bold text-gray-600">Prepared By</label>
                    <input class="form-control rounded bg-gray-600" wire:model="owner" readonly>
                </div>
                <div class="inline-block mt-1 w-1/3 pr-1">
                    <label class="text-sm font-bold text-gray-600">Date prepared</label>
                    <input class="form-control rounded bg-gray-600" readonly wire:model="date">
                </div>
            </div>
            <div class="flex">
                <div class="inline-block mt-1 w-1/4 pr-1">
                    <label class="text-sm font-bold text-gray-600">Decision</label>
                    <select class="form-control" wire:model="decision" required="required">
                        <option value="">Select Status</option>
                        <option value="HOD approved">HOD approved</option>
                        <option value="HOD declined">HOD declined</option>
                    </select>
                </div>
                <div class="inline-block mt-1 w-1/4 pr-1">
                    <label class="text-sm font-bold text-gray-600">Approved By</label>
                    <input class="form-control rounded bg-gray-600" readonly wire:model="supervisor">
                </div>
                <div class="inline-block mt-1 w-1/4 pr-1">
                    <label class="text-sm font-bold text-gray-600">Approval Date</label>
                    <input class="form-control rounded bg-gray-600" readonly wire:model="approvaldate">
                </div>
                <div class="inline-block mt-1 w-1/4 pr-1">
                    <label class="text-sm font-bold text-gray-600">Comment</label>
                    <input class="form-control rounded bg-gray-600" wire:model.lazy="admincomment">
                </div>
            </div>
            <div class="flex justify-between">
                <div class="mt-3">
                    <button type="submit" class="px-4 py-1 text-white font-light tracking-wider bg-green-900 rounded">Update</button>
                </div>
                <div>
                    @foreach($files as $image)
                    <a href="{{route('report.file',$image->id)}}" target="_blank">{{$image->image}}</a>
                    @endforeach
                </div>
            </div>
            <div wire:loading wire:target="update">
                Processing Update...
            </div>
        </form>
        @endif



    </div>
</div>