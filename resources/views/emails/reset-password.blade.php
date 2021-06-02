@component('mail::message')
Dobrý den,

obdrželi jsme žádost o resetování hesla k vašemu účtu.

@component('mail::button', ['url' => route('password.reset', $token)])
Nastavit nové heslo
@endcomponent

@component('mail::panel')
Pokud jste si nevyžádali resetování hesla, není nutné na tuto zprávu reagovat.
@endcomponent

Děkujeme,<br>
tým {{ config('app.name') }}

@component('mail::subcopy')
Pokud máte problém s tlačítkem *"Nastavit nové heslo"*, zkopírujte a vložte tuto URL adresu do prohlížeče:
[{{ route('password.reset', $token) }}]({{ route('password.reset', $token) }})
@endcomponent

@endcomponent
