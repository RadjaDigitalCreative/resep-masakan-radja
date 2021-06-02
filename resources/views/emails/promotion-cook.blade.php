@component('mail::message')
# Gratulujeme k povýšení!

Dobrý den,

s radostí Vám oznamujeme, že jste úspěšně splnili všechny podmínky k povýšení a stáváte se **kuchařem**!

Pod účtem **{{ $user->email }}** nyní **můžete vkládat vlastní recepty**. Vyzkoušejte si to:

@component('mail::button', ['url' => url("recept/novy")])
Napsat nový recept
@endcomponent

@component('mail::panel')
Toto je vaše první povýšení. K druhému povýšení, tentokrát na **šéfkuchaře**, musíte napsat alespoň 10 vlastních receptů.
@endcomponent

Děkujeme,<br>
tým {{ config('app.name') }}

@endcomponent
