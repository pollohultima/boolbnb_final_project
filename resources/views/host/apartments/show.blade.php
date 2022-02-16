@extends('layouts.host')

@section('content')
    <h1 class="text-center py-5">Apartment details page</h1>
    <h2 class="py-3">Titolo: {{ $apartment->title }}</h2>
    <div class="info d-flex flex-column py-3">
        <h3>Stanze: {{ $apartment->rooms }}</h3>
        <h3 class="py-3">Bagni: {{ $apartment->bathrooms }}</h3>
        <h3 class="py-3">Letti: {{ $apartment->beds }}</h3>
        <h3 class="py-3">Metri quadrati: {{ $apartment->squared_meters }}</h3>
    </div>
    <h2 class="py-3">Indirizzo: {{ $apartment->address }}</h2>
@endsection
