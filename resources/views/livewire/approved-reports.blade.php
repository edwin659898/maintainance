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
        <section class="m-1 p-2 w-full flex flex-col rounded border p-1 sm:pt-0">
            <h1 class="font-bold text-xl text-center text-green-900">Approved Reports</h1>
            <div class="flex justify-between px-2 pt-1 pb-4">
                <input type="search" wire:model.debounce.300ms="search" class="border-2 h-8 transition duration-500 border-green-300 text-xs text-center focus:border-green-600 focus:ring-green-700 rounded-md" placeholder="Search...">
                <button wire:click.prevent="GenerateExcel" class="px-4 py-1 rounded-lg text-white tracking-wider bg-green-500 hover:bg-green-700">Export to Excel</button>
            </div>
            @if($comments->count()==0)
            <p class="text-center text-orange-500 mt-2">No available Reports</p>
            @else
            <table class="table">
                <thead class="text-green-900">
                    <tr>
                        <th><input type="checkbox" wire:model="selectAll" class="bg-green-500 outline:none"></th>
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
                <tr class="@if ($this->isChecked($comment->id))
                    table-success
                @endif">
                    <td><input type="checkbox" value="{{ $comment->id }}" wire:model="reports"></td>
                    <td>{{$comment->date}}</td>
                    <td>{{$comment->owner}}</td>
                    <td>{{$comment->site}}</td>
                    <td>{{$comment->machine_name}}</td>
                    <td>{{$comment->number_plate}}</td>
                    <td>{{$comment->type}}</td>
                    <td>{{$comment->status}}</td>
                    <td>
                        <span><a class="cursor-pointer text-blue-500" href="{{route('report.print',$comment->id)}}">View</a></span>
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
    </div>
</div>