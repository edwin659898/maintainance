<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@extends('checklist.layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div>
                @if (session()->has('message'))
                <div class="p-3 bg-green-300 text-green-800 rounded shadow-sm fade-message">
                    {{ session('message') }}
                </div>
                <script>
                    $(function() {
                        setTimeout(function() {
                            $('.fade-message').slideUp();
                        }, 5000);
                    });
                </script>
                @endif
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="font-bold">Submit Maintainance Report</h3>
                </div>

                <div class="card-body">
                    <form action="{{route('report.updateD',$machine->id)}}" method="post" id="form_id">

                        @csrf
                        <h3 class="text-center text-xl font-semibold">{{$machine->machine_name}} {{$machine->type}}</h3>
                        <div class="flex">
                            <div class="inline-block mt-1 w-1/3 pr-1">
                                <label class="text-sm font-bold text-gray-600">Site</label>
                                <input class="form-control rounded bg-gray-600" name="report[site]" type="text" readonly value="{{$machine->site}}">
                            </div>
                            <div class="inline-block mt-1 w-1/3 pr-1">
                                <label class="text-sm font-bold text-gray-600">Machine Name</label>
                                <input class="form-control rounded bg-gray-600" name="report[machine_name]" type="text" readonly value="{{$machine->machine_name}}">
                            </div>
                            <div class="inline-block mt-1 w-1/3 pr-1">
                                <label class="text-sm font-bold text-gray-600">Number Plate</label>
                                <input class="form-control rounded bg-gray-600" name="report[number_plate]" type="text" readonly value="{{$machine->number_plate}}">
                            </div>
                        </div>

                        <section class="mt-2 px-3 py-3 w-full border rounded">
                            <div class="flex justify-between font-semibold uppercase">
                                <span class="w-6/12 ...">Title</span>
                                <span class="w-2/12 ...">Check</span>
                                <span class="w-4/12 ...">Comment</span>
                            </div>
                            @foreach($machine->headers as $list)
                            <div class="mt-2 flex justify-between text-sm">
                                <span class="w-6/12">{{$list->item}}</span>
                                @if($list->answer == "yes")
                                <input  type="hidden" name="listId[]" value="{{$list->id}}" >
                                <span class="w-2/12">{{$list->answer}}</span>
                                <input type="hidden" name="answer[]" class="form-control h-5 w-5 text-green-600" value="{{$list->answer}}">
                                <textarea type="text" placeholder="comment" name="comment[]" rows="1" class="px-2 py-1 relative rounded 
                                  border bg-gray-200 outline-none w-4/12" required>{{$list->comment}}</textarea>
                                @else
                                <label class="w-2/12">
                                <input  type="hidden" name="listId[]" value="{{$list->id}}" >
                                    <input type="checkbox" name="answer[]" class="form-control h-5 w-5 text-green-600" value="yes">
                                </label>
                                <textarea type="text" placeholder="comment" name="comment[]" rows="1" class="px-2 py-1 relative rounded 
                                  border bg-gray-200 outline-none w-4/12" required>{{$list->comment}}</textarea>
                                @endif
                            </div>
                            @endforeach
                        </section>
                        <span class="mt-2 text-red-500 font-bold">Initial Milage: {{$machine->milage}}</span> 
                        <div class="mt-2">
                            <input type="number" step="0.01" id="a" class="w-full bg-gray-200 form-control rounded" name="milage" placeholder="Milage as read on dashboard" required />
                        </div>
                        <div class="flex">
                            <div class="inline-block mt-1 w-1/3 pr-1">
                                <label class="text-sm font-bold text-gray-600">Prepared By</label>
                                <input class="form-control rounded bg-gray-600" name="report[owner]" type="text" readonly value="{{$machine->owner}}">
                            </div>
                            <div class="inline-block mt-1 w-1/3 pr-1">
                                <label class="text-sm font-bold text-gray-600">Hours to next Schedule</label>
                                <input type="hidden" id="b" value="{{$data->worked_hours}}" /> 
                                <input type="hidden" id="c" value="" name="result2" /> 
                                <input type="hidden" id="d" value="{{$data->plan_hours}}"/>
                                <input class="form-control rounded bg-gray-600" name="plan_hours" type="number" readonly value="{{$data->plan_hours}}">
                            </div>
                            <div class="inline-block mt-1 w-1/3 pr-1">
                                <label class="text-sm font-bold text-gray-600">Date</label>
                                <input class="form-control rounded bg-gray-600" name="report[date]" type="text" readonly value="{{$machine->date}}">
                                <input class="form-control rounded bg-gray-600" name="type" type="hidden" readonly value="{{$machine->type}}">
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="px-4 py-1 text-white font-light tracking-wider bg-green-900 rounded">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  const form = document.forms.form_id;
  form.onkeyup = ()=>{
    form["result2"].value=parseInt(Number(form.a.value))-parseInt(Number(form.b.value));form["plan_hours"].value=parseInt(Number(form.d.value))-parseInt(Number(form.c.value))
  }
</script>
@endsection
