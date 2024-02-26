<div class="justify-content-center">
  @if(session()->has('message'))
  <div class="alert alert-success">{{session()->get('message')}}</div>
  @elseif(session()->has('error'))
  <div class="alert alert-danger text-center">{{session()->get('error')}}</div>
  @endif
</div>