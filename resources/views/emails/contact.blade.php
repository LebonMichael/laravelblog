@component('mail::message')
<h1>Message from website</h1>
<p>Name:</p>{{$data['name']}}
<p>Email:</p>{{$data['email']}}
<p>Message:</p>{{$data['message']}}

@component('mail::button', ['url' => 'https://www.syntrawest.be'])
    Visit our website.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
