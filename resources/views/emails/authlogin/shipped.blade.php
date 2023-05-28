<x-mail::message>
    # Sisteme Giris Yaptiniz

    # Datetime {{$data['date']}}

    # Remote Addr {{$data['remote_addr']}}
    # Server Addr {{$data['server_addr']}}
    # Browser {{$data['http_user_agent']}}

    Kolayliklar dileriz,Iyi calismalar<br>
    {{ config('app.name') }}
</x-mail::message>
