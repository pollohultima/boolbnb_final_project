@extends('layouts.host')

@section('content')
<div class="edit_sec">
    <h1 class="title_page">Modifica {{ $apartment->title }}</h1>

    <form action="{{ route('host.apartments.update', $apartment->slug) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

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
            <input type="text" name="title" id="title" class="form-control @error('title') is_invalid @enderror" placeholder="Type your title" aria-describedby="helpId" value="{{ old('title') ? old('title') : $apartment->title  }}">
        </div>

        <div class="mb-3">
            <label for="rooms" class="form-label">Stanze</label>
            <input type="text" name="rooms" id="rooms" class="form-control  @error('rooms') is_invalid @enderror" placeholder="Type your rooms" aria-describedby="helpId" value="{{ old('rooms') ? old('rooms') : $apartment->rooms  }}">
        </div>

        <div class="mb-3">
            <label for="bathrooms" class="form-label">Bagni</label>
            <input type="text" name="bathrooms" id="bathrooms" class="form-control  @error('bathrooms') is_invalid @enderror" placeholder="Type your bathrooms" aria-describedby="helpId" value="{{ old('bathrooms') ? old('bathrooms') : $apartment->bathrooms  }}">
        </div>

        <div class="mb-3">
            <label for="beds" class="form-label">Posti letto</label>
            <input type="text" name="beds" id="beds" class="form-control  @error('beds') is_invalid @enderror" placeholder="Type your beds" aria-describedby="helpId" value="{{ old('beds') ? old('beds') : $apartment->beds  }}">
        </div>

        <div class="mb-3">
            <label for="squared_meters" class="form-label">Metri quadrati</label>
            <input type="text" name="squared_meters" id="squared_meters" class="form-control  @error('squared_meters') is_invalid @enderror" placeholder="Type your squared_meters" aria-describedby="helpId" value="{{ old('squared_meters') ? old('squared_meters') : $apartment->squared_meters  }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Indirizzo</label>
            <div id="searchbox" style="border-radius: 50px;"></div>
            <input type="text" style="display:none;" id="temp_address" value="{{ old('address') ? old('address') : $apartment->address  }}">
           
            
        </div>

        <div class="mb-3 change_img_wrapper">

            <div class="row py-4">
                <div class="col img_thumb_wrapper">
                    <img style="max-height: 300px; max-width:300px"
                        src="{{ asset('storage/' . $apartment->image) }}" alt="" class="img_thumbnail">
                </div>
                <div class="col">
                    <label for="image" class="form-label">Cambia l'immagine
                        dell'appartamento</label>
                    <input type="file" accept="images/*" name="image" id="image" class="form-control  @error('image') is_invalid @enderror" placeholder="image" aria-describedby="helpId">
                </div>

            </div>

        </div>

        <div class="mb-3">
            <label for="floor" class="form-label">Piano</label>
            <input type="text" name="floor" id="floor" class="form-control  @error('floor') is_invalid @enderror" placeholder="Type your floor" aria-describedby="helpId" value="{{ old('floor') ? old('floor') : $apartment->floor  }}">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Prezzo</label>
            <input type="text" name="price" id="price" class="form-control  @error('price') is_invalid @enderror" placeholder="Type your price" aria-describedby="helpId" value="{{ old('price') ? old('price') : $apartment->price  }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control" name="description" id="description" rows="5" @error('description') is_invalid @enderror placeholder="Inserisci una breve descrizione" aria-describedby="helpId">{{ old('description') ? old('description') : $apartment->description  }}</textarea>
        </div>


        <div class="mb-3">
            <label for="is_visible" class="form-label">Visibile online</label>
            <select multiple class="form-select" name="is_visible" id="is_visible">
                <option disabled>Is visible </option>
                <option {{ $apartment->is_visible = 1 ? 'selected' : '' }} value="1">Si</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="services" class="form-label">Servizi</label>
            <select multiple class="form-select" name="services[]" id="services">
                <option disabled>Seleziona uno o più servizi</option>
                @foreach ($services as $service)
                <option value="{{ $service->id }}" {{ $apartment->services->contains($service->id) ? 'selected' : '' }}>{{ $service->name }}
                </option>
                @endforeach

            </select>
        </div>



        <button type="submit" class="button">Applica le modifiche</button>

    </form>
</div>
@endsection