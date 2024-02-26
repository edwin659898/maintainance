<div class="card bg-gray-100">
    <div class="card-header">
        <h3 class=>My Hourly/KM Plans</h3>
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
            @if($machines->count()==0)
            <p class="text-center text-orange-500 mt-2">No Machine Available for Schedule</p>
            @else
            <table class="table">
                <thead class="text-green-900">
                    <th>Machine Name</th>
                    <th>Number Plate</th>
                    <th>Milage</th>
                    <th>Plan</th>
                    <th>Hours Remaining</th>
                    <th>Start</th>
                </thead>
                @foreach($machines as $machine)
                <tr>
                <form action="{{route('search.list')}}" method="post">
                   @csrf
                  <input type="hidden" name="machine_name" value="{{$machine->machine_name}}">
                  <input type="hidden" name="number_plate" value="{{$machine->number_plate}}">
                    <td>{{$machine->machine_name}}</td>
                    <td>{{$machine->number_plate}}</td>
                    <td>{{$machine->worked_hours}}</td>
                    <input type="hidden" name="type" value="{{$machine->plan}}">
                    <td>{{$machine->plan}}</td>
                    <td>{{$machine->plan_hours}}</td>
                    @if($machine->approved_plan && $machine->completed != TRUE)
                    <td><button type="submit" class="px-2 py-1 text-white font-light tracking-wider bg-blue-500 rounded">Start</button></td>
                    </form>
                    @elseif($machine->approved_plan && $machine->completed == TRUE)
                    <td>Completed</td>
                    @else
                    <td>Pending</td>
                    @endif
                </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            <div class="mt-2">
                {{$machines->links('pagination')}}
            </div>
        </section>
    </div>
</div>