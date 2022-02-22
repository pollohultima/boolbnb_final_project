@extends('layouts.host')

@section('content')
    <div class="show_sec">
        <div class="card m-4">

            <!-- image -->
            <div class="top">
                <div class="image">
                    <img src=" {{ asset('storage/' . $apartment->image) }}" class="img-fluid" alt="...">
                </div>
            </div>

            <!-- infos -->
            <div class="mid py-3">
                <div class="container">
                    <div class="row">

                        <!-- map -->
                        <div id="map" class="map col-5">

                        </div>

                        <!-- details -->
                        <div class="infos col-7 px-4">

                            <!-- titolo -->
                            <h2 class="pt-3">{{ $apartment->title }}</h2>
                            <h3 class="pb-4 col-9 info_address"> <i class="fa-solid fa-location-dot"></i>
                                {{ $apartment->address }}</i></h3>

                            <div class="details container">
                                <div class="row">

                                    <div class="col">
                                        <div class="item">
                                            <h3>Stanze: </h3>
                                            <h3 class="value">{{ $apartment->rooms }}</h3>
                                        </div>
                                        <div class="item">
                                            <h3 class="py-1">Bagni: </h3>
                                            <h3 class="py-1 value">{{ $apartment->bathrooms }}</h3>
                                        </div>
                                        <div class="item">
                                            <h3 class="py-1">Letti: </h3>
                                            <h3 class="py-1 value">{{ $apartment->beds }}</h3>
                                        </div>
                                        <div class="item">
                                            <h3 class="py-1">Piano: </h3>
                                            <h3 class="py-1 value">{{ $apartment->floor }}</h3>
                                        </div>
                                        <div class="item">
                                            <h3 class="py-1">Metri quadrati: </h3>
                                            <h3 class="py-1 value">{{ $apartment->squared_meters }}</h3>
                                        </div>
                                        <div class="item">
                                            <h3 class="py-1">Attualmente visibile: </h3>
                                            @if ($apartment->is_visible)
                                                <h3 class="py-1 value">Sì</h3>
                                            @else
                                                <h3 class="py-1 value">No</h3>
                                            @endif
                                        </div>
                                        <div class="item item_price">
                                            <h3 class="py-1">Prezzo: </h3>
                                            <h3 class="py-1 value">{{ $apartment->price }}€</h3>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="bottom py-3">
                    <div class="services">
                        <h2>Servizi</h2>

                        <ul class="row">
                            <li class="col-4"><i class="fa-solid fa-circle-check"></i> piscina</li>
                            <li class="col-4"><i class="fa-solid fa-circle-check"></i> sauna</li>
                            <li class="col-4"><i class="fa-solid fa-circle-check"></i> wifi</li>
                        </ul>
                    </div>
                    <hr>
                    <div class="description">
                        <h2>Descrizione</h2>

                        <p class="py-1"> {{ $apartment->description }} </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.15.0/maps/maps-web.min.js"></script>
    <script>
        var lati = "<?php echo "$lati"; ?>";
        var long = "<?php echo "$long"; ?>";

        console.log(lati);

        var HomeCoordinates = [long, lati];

        var map = tt.map({
            key: '3a6pOX546txENpMTLIdG3as2UoLVCypG',
            container: 'map',
            center: HomeCoordinates,
            zoom: 15
        });

        var marker = new tt.Marker().setLngLat(HomeCoordinates).addTo(map);
    </script>
@endsection
