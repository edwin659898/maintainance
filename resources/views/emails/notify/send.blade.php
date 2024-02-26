@component('mail::message')
# Dear User

{{$sender->name}} submitted a new Maintainance Report

@component('mail::button', ['url' => route('report.view')])
View Report
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
 