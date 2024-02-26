<div class="card bg-gray-100">
  <div class="card-header">
    <h3>My Schedule</h3>
  </div>
  <div class="card-body">
    <div>
      @if(session()->has('message'))
      <div class="alert alert-success">{{session()->get('message')}}</div>
      @elseif(session()->has('error'))
      <div class="alert alert-danger text-center">{{session()->get('error')}}</div>
      @endif
    </div>
    <section class="m-1 p-2 w-12/12 flex flex-col rounded border justify-center p-1 sm:pt-0">
      <h1 class="font-bold text-xl text-center text-green-900">Machines Available</h1>
      @if($comments->count()==0)
      <p class="text-center text-orange-500 mt-2">No Machine Available in your plan</p>
      @else
      <table cellpadding="10">
        <thead class="text-green-900">
          <tr>
            <th>Machine Name</th>
            <th>Number Plate</th>
            <th>Maintainanced Date</th>
            <th>Comments</th>
            <th>Start Process</th>
            <th>UnSchedule</th>
          </tr>
        </thead>
        @foreach($comments as $comment)
        <tr>
          <td>{{$comment->machine_name}}</td>
          <td>{{$comment->number_plate}}</td>
          <td>{{$comment->date}}</td>
          <td>{{$comment->comment}}</td>
          @if($comment->approved_plan && $comment->completed != TRUE)
          <td>
            <form action="{{route('search.list')}}" method="POST">
              @csrf
              <input type="hidden" name="machine_name" value="{{$comment->machine_name}}">
              <input type="hidden" name="number_plate" value="{{$comment->number_plate}}">
              <input type="hidden" name="type" value="{{$comment->type}}">
              <button type="submit" class="px-2 py-1 text-white font-light tracking-wider bg-blue-500 rounded">Start</button>
            </form>
          </td>
          @elseif($comment->approved_plan && $comment->completed == TRUE)
          <td>Completed</td>
          @else
          <td>Pending</td>
          @endif
          @if($comment->approved_plan == 0)
          <td class="text-red-500"><i role="button" class="icon-large icon-remove" wire:click="remove({{$comment->id}})"></i>
          </td>
          @else
          <td></td>
          @endif
        </tr>
        @endforeach
        </tbody>
      </table>
      @endif
      <div class="mt-2">
        {{$comments->links('pagination')}}
      </div>
    </section>
  </div>
</div>