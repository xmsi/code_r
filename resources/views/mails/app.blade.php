@component('mail::message')

<h3>{{ $name }} записался на консультацию <span style="color: orange;">{{ $date }}</span > числа. Номер: {{ $phone }}</h3>

@endcomponent