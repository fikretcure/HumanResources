<x-mail::message>
# Uyelik Daveti

Baglantiya tiklayarak sifrenizi belirleyip, sistemi kullanmaya baslayabilirsiniz

{{env('FRONT_TEST_URL')}}/subscription-completion?token={{$data['token']}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
