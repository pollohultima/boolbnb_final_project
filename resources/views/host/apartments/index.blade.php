@extends('layouts.host')


@section('content')
    <div class="apartments_sec">
        <div class="add_apartment">
            <h1 class="title_page">I tuoi appartamenti</h1>


            <a name="" id="" class="button" style="margin-right: 150px;"
                href="{{ route('host.apartments.create') }}" role="button">

               <span class="add_appear">Aggiungi un appartamento</span>
               <span class="add_plus_appear">
               <!-- <i class="fa-solid fa-plus plus_icon"></i> -->
               <i class="fa-solid fa-house"></i>
               </span>
            </a>
        </div>

        @if (count($apartments)== 0)
                <h3>&#128549; non ci sono appartamenti da mostrare</h3>

                @endif

        



        @foreach ($apartments as $apartment)
              


            <div class="card mb-5 apartment_card">
                <div class="row g-0">

                    <div class="col-md-3 apartment_card_img">
                        <img src=" {{ asset('storage/' . $apartment->image) }}" class="img-fluid" alt="...">
                    </div>

                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card_title">{{ $apartment->title }}</h4>
                            <p class="card_desc card_desc_subtitle">{{ $apartment->description }}</p>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card_desc card_desc_address">
                                        <p>


                                            Indirizzo:
                                        </p>
                                        <span
                                            class="apartment_info apartment_info_adress">{{ $apartment->address }}</span>
                                    </div>
                                    <div class="card_desc">
                                        <p>

                                            Stanze:</p>
                                        <span class="apartment_info">{{ $apartment->rooms }}</span>
                                    </div>
                                    <div class="card_desc">

                                        <p>
                                            Bagni:</p>
                                        <span class="apartment_info">{{ $apartment->bathrooms }}</span>
                                    </div>
                                    <div class="card_desc">
                                        <p>
                                            Letti:</p>
                                        <span class="apartment_info">{{ $apartment->beds }}</span>
                                    </div>
                                    <div class="card_desc">
                                        <p>

                                            Metri quadrati:</p>
                                        <span class="apartment_info">{{ $apartment->squared_meters }}</span>
                                    </div>
                                    <div class="card_desc">
                                        <p>Piano:</p>
                                        <span class="apartment_info">{{ $apartment->floor }}</span>
                                    </div>
                                    <div class="card_desc">
                                        <p class="card-text">Prezzo:</p>
                                        <p class="price_info apartment_info">{{ $apartment->price }}
                                            <span class="dollar">€</span>
                                        </p>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-md-1 actions">



                        <a href="{{ route('host.apartments.show', $apartment->slug) }}">
                            <i class="fas fa-eye fa-lg fa-fw " title="visita appartamento"></i>
                        </a>


                        <a href="{{ route('host.apartments.edit', $apartment->slug) }}">
                             <i class="fas fa-pencil-alt fa-lg fa-fw" title="modifica appartamento"></i>
                        </a>

                        <!-- BOTTONE GRAFICO -->
                        <a href="#">
                           <i class="fa-solid fa-chart-line" title="statistiche"></i>
                        </a>

                        
                         <!-- BOTTONE MESSAGGI -->
                        <a href="#">
                           <i class="fa-solid fa-message" title="messaggi"></i>
                        </a>

                            

                        <!-- Button trigger modal -->
                        <a data-bs-toggle="modal" data-bs-target="#delete{{ $apartment->slug }}">
                            <i class="fas fa-trash fa-lg fa-fw" title="cancella appartamenti"></i>
                        </a>

                        

                        <!-- Modal -->
                        <div class="modal fade" id="delete{{ $apartment->slug }}" tabindex="-1" role="dialog"
                            aria-labelledby="modal-{{ $apartment->slug }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete apartment {{ $apartment->slug }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Vuoi davvero cancellare l'appartmento?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="close_button" data-bs-dismiss="modal">Close</button>
                                        <form action="{{ route('host.apartments.destroy', $apartment->slug) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="button">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        @endforeach


        
     



    </div>

    {{ $apartments->links() }}
@endsection
