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
                    <form action="{{route('store.reportB',$machine->id)}}" method="post">

                        @csrf
                        <h3 class="text-center text-xl font-semibold">{{$data->machine_name}} {{$data->hours}}</h3>
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
                            @foreach($data->checklist as $list)
                            <div class="mt-2 flex justify-between text-sm">
                                <span class="w-6/12">{{$list->checklist}}</span>
                                <input type="hidden" name="list[{{$loop->index}}][item]" value="{{$list->checklist}}">
                                <label class="w-2/12">
                                    <input type="hidden" name="list[{{$loop->index}}][answer]" value="no">  
                                    <input type="checkbox" name="list[{{$loop->index}}][answer]" class="form-checkbox h-5 w-5 text-green-600" value="yes">
                                </label>
                                <textarea type="text" placeholder="comment" name="list[{{$loop->index}}][comment]" rows="1" class="px-2 py-1 relative rounded 
                                  border bg-gray-200 outline-none w-4/12" required></textarea>
                            </div>
                            @endforeach
                        </section>
                        <div class="flex">
                            <div class="inline-block mt-1 w-1/2 pr-1">
                                <label class="text-sm font-bold text-gray-600">Next Hourly Maintainance Name</label>
                                <input class="form-control rounded bg-gray-600" name="report[plan]" type="number">
                            </div>
                            <div class="inline-block mt-1 w-1/2 pr-1">
                                <label class="text-sm font-bold text-gray-600">Hours Remaining to next Hourly Maintainance</label>
                                <input class="form-control rounded bg-gray-600" name="report[plan_hours]" type="number">
                            </div>
                        </div>
                        <div class="flex">
                            <div class="inline-block mt-1 w-1/2 pr-1">
                                <label class="text-sm font-bold text-gray-600">Prepared By</label>
                                <input class="form-control rounded bg-gray-600" name="report[owner]" type="text" readonly value="{{auth()->user()->name}}">
                            </div>
                            <div class="inline-block mt-1 w-1/2 pr-1">
                                <label class="text-sm font-bold text-gray-600">Date</label>
                                <input class="form-control rounded bg-gray-600" name="report[date]" type="text" readonly value="{{ date('Y-m-d') }}">
                                <input  name="report[type]" type="hidden" readonly value="{{$data->hours}}">
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="px-4 py-1 text-white font-light tracking-wider bg-green-900 rounded">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection