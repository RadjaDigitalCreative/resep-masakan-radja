@component('mail::message')
# Selamat Datang di Resep Masakan Indonesia!

Selamat siang,

Anda telah berhasil mendaftar Resep Masakan Indonesia. Email Anda untuk masuk adalah **{{ $user->email }}**.

Verifikasi alamat email Anda untuk membuka kunci potensi penuh portal:

@component('mail::button', ['url' => url("registrace/overeni/{$user->token}")])
Verifikasi email
@endcomponent

@component('mail::panel')
Resep Masakan Indonesia adalah tempat resep dicari dan dievaluasi. Cukup tulis apa yang Anda temukan di lemari es, di dapur, atau mungkin di ruang bawah tanah dan cari tahu resep masakan yang bisa Anda buat darinya!
@endcomponent

Terima kasih<br>
team, Resep Masakan Indonesia

@endcomponent
