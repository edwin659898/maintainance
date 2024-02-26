@extends('checklist.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="leading-loose">
            @livewire('checklist')              
              </div>
            </div>
        </div>
    </div>
</div>
@endsection