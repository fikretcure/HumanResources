<x-mail::message>
# Sifre Yenileme

Baglantiya tiklayarak yeni sifrenizi belirleyebilirsiniz.

{{env('FRONT_TEST_URL')}}/forgot-password?token={{$data['token']}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
