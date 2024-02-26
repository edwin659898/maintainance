<div class="card bg-gray-100">
  <div class="card-header">
    <h3>Prepare Schedule</h3>
  </div>
  <div class="card-body">
    <div>
    @if(session()->has('message'))
            <div class="alert alert-success">{{session()->get('message')}}</div>
            @elseif(session()->has('error'))
            <div class="alert alert-danger text-center">{{session()->get('error')}}</div>
            @endif
    </div>
    <section class="m-1 p-2 w-12/12 flex flex-col rounded border p-1 sm:pt-0">
      <h1 class="font-bold text-xl text-center text-green-900">Machines Available</h1>
      @if($comments->count()==0)
      <p class="text-center text-orange-500 mt-2">No Machine Available for Schedule</p>
      @else
      <table class="table">
        <thead class="text-green-900">
          <tr>
            <th>Machine Name</th>
            <th>Number Plate</th>
            <th>Maintainanced Date</th>
            <th>Scheduled Type</th>
            <th>Schedule</th>
          </tr>
        </thead>
        @foreach($comments as $comment)
        @if($comment->plan_hours <= 1) <tr class="bg-red-500">
          <td>{{$comment->machine_name}}</td>
          <td>{{$comment->number_plate}}</td>
          <td>{{$date}}</td>
          <td>{{$scheduleType}}</td>
          <td>Overdue
          </td>
          </tr>
          @elseif(($comment->plan/10) > $comment->plan_hours)
          <tr class="bg-yellow-500">
            <td>{{$comment->machine_name}}</td>
            <td>{{$comment->number_plate}}</td>
            <td>{{$date}}</td>
            <td>{{$scheduleType}}</td>
            <td><a role="button" class="p-2 bg-blue-500 w-20 rounded shadow text-white" wire:click="remove({{$comment->id}})">Add</a>
            </td>
          </tr>
          @else
          <tr>
            <td>{{$comment->machine_name}}</td>
            <td>{{$comment->number_plate}}</td>
            <td>{{$date}}</td>
            <td>{{$scheduleType}}</td>
            <td><a role="button" class="p-2 bg-blue-500 w-20 rounded shadow text-white" wire:click="remove({{$comment->id}})">Add</a>
            </td>
          </tr>
          @endif
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