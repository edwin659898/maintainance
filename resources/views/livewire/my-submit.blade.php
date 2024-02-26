<div class="card bg-gray-100">
    <div class="card-header">
        <h3>My Reports</h3>
    </div>
    <div class="card-body">
        <section class="m-1 p-2 w-12/12 flex flex-col rounded border p-1 sm:pt-0">
            <h1 class="font-bold text-xl text-center text-green-900">Submitted Reports</h1>
            @if($comments->count()==0)
            <p class="text-center text-orange-500 mt-2">No available Reports</p>
            @else
            <table class="table">
                <thead class="text-green-900">
                    <tr>
                        <th>Date Prepared</th>
                        <th>Machine Name</th>
                        <th>Number Plate</th>
                        <th>Checklist Type</th>
                        <th>Status</th>
                        <th>HOD comment</th>
                        <th>Details</th>
                    </tr>
                </thead>
                @foreach($comments as $comment)
                <tr>
                    <form action="{{route('report.mine',$comment->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="machine_name" value="{{$comment->machine_name}}">
                        <input type="hidden" name="number_plate" value="{{$comment->number_plate}}">
                    <td>{{$comment->date}}</td>
                    <td>{{$comment->machine_name}}</td>
                    <td>{{$comment->number_plate}}</td>
                    <td>{{$comment->type}}</td>
                    <td>{{$comment->status}}</td>
                    <td>{{$comment->admincomment}}</td>
                    <td>
                    <button class="px-2 py-1 text-white font-light tracking-wider bg-green-900 rounded" type="submit">View</button>
                    </td>
                    </form>
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

