@extends('layouts.host')


@section('content')
    <h1>Apartments</h1>
    <div class="row justify-content-end">


        <a name="" id="" class="col-1 btn btn-primary text-white float-end" style="margin-right: 150px;"
            href="{{ route('host.apartments.create') }}" role="button">Create
            apartment</a>
    </div>

    @foreach ($apartments as $apartment)
        <div class="card mb-3">
            <div class="row g-0">

                <div class="col-md-3">
                    <img style="max-width: 300px;" src=" {{ asset('storage/' . $apartment->image) }}"
                        class="img-fluid rounded" alt="...">
                </div>

                <div class="col-md-7">
                    <div class="card-body">
                        <h4 class="card-title">{{ $apartment->title }}</h4>
                        <p class="card-text">{{ $apartment->description }}</p>

                        <div class="row">
                            <div class="col-4">
                                <p class="card-text">Indirizzo: {{ $apartment->address }}</p>
                            </div>

                            <div class="col-4">
                                <p class="card-text">Stanze: {{ $apartment->rooms }}</p>
                                <p class="card-text">Bagni: {{ $apartment->bathrooms }}</p>
                                <p class="card-text">Letti: {{ $apartment->beds }}</p>
                                <p class="card-text">Metri quadrati: {{ $apartment->squared_meters }}</p>
                            </div>

                            <div class="col-4">
                                <p class="card-text">Piano: {{ $apartment->floor }}</p>
                                <p class="card-text">Prezzo: €{{ $apartment->price }} </p>
                            </div>
                        </div>





                    </div>
                </div>

                <div class="col-md-2">
                    <a href="{{ route('host.apartments.show', $apartment->slug) }}"><i
                            class="fas fa-eye fa-lg fa-fw "></i></a>
                    <a href="{{ route('host.apartments.edit', $apartment->slug) }}"> <i
                            class="fas fa-pencil-alt fa-lg fa-fw"></i></a>

                    <!-- Button trigger modal -->

                    <a data-bs-toggle="modal" data-bs-target="#delete{{ $apartment->slug }}">
                        <i class="fas fa-trash fa-lg fa-fw text-danger"></i>
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
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <form action="{{ route('host.apartments.destroy', $apartment->slug) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    @endforeach

    {{ $apartments->links() }}
@endsection
