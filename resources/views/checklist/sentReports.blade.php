@extends('checklist.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="leading-loose">
            <div>
            @if(session()->has('message'))
            <div class="alert alert-success">{{session()->get('message')}}</div>
            @elseif(session()->has('error'))
            <div class="alert alert-danger text-center">{{session()->get('error')}}</div>
            @endif
        </div>
                @livewire('my-submit')
            </div>
        </div>
    </div>
</div>
</div>
@endsection