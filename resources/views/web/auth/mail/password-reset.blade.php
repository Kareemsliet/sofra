<x-mail::message>
# Introduction

Reset Password

<x-mail::button :url="$url" >
Reset Password
</x-mail::button>

Thanks,<br>
{{config('app.name')}}
</x-mail::message>
