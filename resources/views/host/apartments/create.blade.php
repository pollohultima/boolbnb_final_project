@extends('layouts.host')

@section('content')
    <div class="create_sec">
        <h1>Aggiungi un nuovo appartamento</h1>

        <form action="{{ route('host.apartments.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is_invalid @enderror"
                    placeholder="Inserisci il titolo" aria-describedby="helpId" value="{{ old('title') }}">
            </div>

            <div class="mb-3">
                <label for="rooms" class="form-label">Stanze</label>
                <input type="text" name="rooms" id="rooms" class="form-control  @error('rooms') is_invalid @enderror"
                    placeholder="Inserisci il numero di stanze" aria-describedby="helpId" value="{{ old('rooms') }}">
            </div>

            <div class="mb-3">
                <label for="bathrooms" class="form-label">Bagni</label>
                <input type="text" name="bathrooms" id="bathrooms"
                    class="form-control  @error('bathrooms') is_invalid @enderror"
                    placeholder="Inserisci il numero di bagni" aria-describedby="helpId" value="{{ old('bathrooms') }}">
            </div>

            <div class="mb-3">
                <label for="beds" class="form-label">Posti letto</label>
                <input type="text" name="beds" id="beds" class="form-control  @error('beds') is_invalid @enderror"
                    placeholder="Inserisci il numero di posti letto" aria-describedby="helpId" value="{{ old('beds') }}">
            </div>

            <div class="mb-3">
                <label for="squared_meters" class="form-label">Metri quadrati</label>
                <input type="text" name="squared_meters" id="squared_meters"
                    class="form-control  @error('squared_meters') is_invalid @enderror"
                    placeholder="Inserisci i metri quadrati" aria-describedby="helpId"
                    value="{{ old('squared_meters') }}">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <div id="searchbox" value="{{ old('address') }}" style="border-radius: 50px;"></div>
                {{-- <input type="text" name="address" id="address" class="form-control  @error('address') is_invalid @enderror"
                placeholder="Esempio: Via Roma 1 Padova Italy" aria-describedby="helpId" value="{{ old('address') }}"> --}}
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Immagine dell'appartamento</label>
                <input type="file" accept="images/*" name="image" id="image"
                    class="form-control  @error('image') is_invalid @enderror"
                    placeholder="Inserisci l'immagine dell'appartamento" aria-describedby="helpId">
            </div>

            <div class="mb-3">
                <label for="floor" class="form-label">Piano</label>
                <input type="text" name="floor" id="floor" class="form-control  @error('floor') is_invalid @enderror"
                    placeholder="Inserisci il piano" aria-describedby="helpId" value="{{ old('floor') }}">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Prezzo</label>
                <input type="text" name="price" id="price" class="form-control  @error('price') is_invalid @enderror"
                    placeholder="Inserisci il prezzo" aria-describedby="helpId" value="{{ old('price') }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                {{-- <input type="text-area" name="description" id="description"
                class="form-control  @error('description') is_invalid @enderror"
                placeholder="Inserisci una breve descrizione" aria-describedby="helpId" value="{{ old('description') }}"> --}}
                <textarea class="form-control" name="description" id="description" rows="5"
                    @error('description') is_invalid @enderror placeholder="{{ old('description') }}"
                    aria-describedby="helpId"></textarea>
            </div>


            <div class="mb-3">
                <label for="is_visible" class="form-label">Visibile online</label>
                <select multiple class="form-select" name="is_visible" id="is_visible">
                    <option disabled>Vuoi che sia visibile a tutti?</option>
                    <option value="1">Si</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="services" class="form-label">Servizi</label>
                <select multiple class="form-select" name="services[]" @error('services') is_invalid @enderror
                    id="services">
                    <option disabled>Seleziona uno o più servizi</option>

                    @foreach ($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }} </option>
                    @endforeach

                </select>
            </div>

            <button type="submit" class="button">Aggiungi appartamento</button>

        </form>
    </div>
@endsection
