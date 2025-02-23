<x-mail::message>
# Test Users

Hello {{ $user->name }}, <br/>

The body of your message.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
