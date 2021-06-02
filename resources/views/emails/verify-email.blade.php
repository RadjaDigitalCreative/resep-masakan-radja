@component('mail::message')

Selamat siang,

Kami mengirimi Anda tautan untuk memverifikasi alamat email Anda ** {{$ user-> email}} **.

Klik tombol di bawah untuk memverifikasi alamat email Anda dan membuka kunci potensi penuh {{config ('app.name')}}:

@component('mail::button', ['url' => url("registrace/overeni/{$user->token}")])
Verifikasi email
@endcomponent

Terima kasih<br>
team Resep Masakan Indonesia

@component('mail::subcopy')
Jika Anda memiliki masalah dengan tombol * "Verifikasi Email" *, salin dan tempel URL ini ke browser Anda:
[{{ url("registrace/overeni/{$user->token}") }}]({{ url("registrace/overeni/{$user->token}") }})
@endcomponent

@endcomponent
