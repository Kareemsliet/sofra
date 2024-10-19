<x-mail::message>

اهلا {{$name}}

<x-mail::panel>
    {{$description}}
</x-mail::panel>

شكرا,<br>
{{ config('app.name') }}
</x-mail::message>
