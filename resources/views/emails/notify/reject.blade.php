@component('mail::message')
# Dear User

{{$sender->name}} Rejected Your Maintainance Report

@component('mail::button', ['url' => route('myreports')])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
