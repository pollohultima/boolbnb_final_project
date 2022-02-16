@extends('layouts.host')

@section('content')
    <h1 class="text-center py-5">Apartment details page</h1>
   <h2 class="py-3">Title:{{$apartment->title}}</h2> 
    <div class="info d-flex flex-column py-3">
        <h3>rooms:{{$apartment->rooms}}</h3>
        <h3 class="py-3">bathrooms:{{$apartment->bathrooms}}</h3>
        <h3 class="py-3">beds:{{$apartment->beds}}</h3>
        <h3 class="py-3">squared_meters:{{$apartment->squared_meters}}</h3>
    </div>
    <h2 class="py-3">Address:{{$apartment->address}}</h2>
@endsection
