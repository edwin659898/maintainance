@extends('checklist.layout')

@section('content')
<style>
    .fc-title {
        font-size: 0.8rem;
        color: black;
    }
</style>
<link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.0.1/fullcalendar.min.css' />
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div>
                    @if(session()->has('message'))
                    <div class="alert alert-success">{{session()->get('message')}}</div>
                    @elseif(session()->has('error'))
                    <div class="alert alert-danger text-center">{{session()->get('error')}}</div>
                    @endif
                </div>
                <div class="card-header">
                    <div class="flex justify-between">
                        <h5>Scheduled Maintainance</h5>
                        <span class="font-bold"><a href="{{route('myreports')}}">My Reports</a></span>
                    </div>
                </div>

                <div class="card-body">
                    <h3>Calendar</h3>
                    <div class="text-blue-500" id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            events: [
                @foreach($tasks as $task) {
                    title: '{{ $task->machine_name }}',
                    start: '{{ $task->date }}',
                },
                @endforeach
            ]
        })
    });
</script>
@endsection