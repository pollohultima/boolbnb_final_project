@extends('layouts.host')

@section('content')
    <h1>Create a new post</h1>

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
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is_invalid @enderror"
                placeholder="Type your title" aria-describedby="helpId" value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label for="rooms" class="form-label">Rooms</label>
            <input type="text" name="rooms" id="rooms" class="form-control  @error('rooms') is_invalid @enderror"
                placeholder="Type your rooms" aria-describedby="helpId" value="{{ old('rooms') }}">
        </div>

        <div class="mb-3">
            <label for="bathrooms" class="form-label">bathrooms</label>
            <input type="text" name="bathrooms" id="bathrooms" class="form-control  @error('bathrooms') is_invalid @enderror"
                placeholder="Type your bathrooms" aria-describedby="helpId" value="{{ old('bathrooms') }}">
        </div>

        <div class="mb-3">
            <label for="beds" class="form-label">beds</label>
            <input type="text" name="beds" id="beds" class="form-control  @error('beds') is_invalid @enderror"
                placeholder="Type your beds" aria-describedby="helpId" value="{{ old('beds') }}">
        </div>

        <div class="mb-3">
            <label for="squared_meters" class="form-label">squared_meters</label>
            <input type="text" name="squared_meters" id="squared_meters"
                class="form-control  @error('squared_meters') is_invalid @enderror" placeholder="Type your squared_meters"
                aria-describedby="helpId" value="{{ old('squared_meters') }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">address</label>
            <input type="text" name="address" id="address" class="form-control  @error('address') is_invalid @enderror"
                placeholder="Type your address" aria-describedby="helpId" value="{{ old('address') }}">
        </div>


        <div class="mb-3">
            <label for="longitude" class="form-label">longitude</label>
            <input type="text" name="longitude" id="longitude"
                class="form-control  @error('longitude') is_invalid @enderror" placeholder="Type your longitude"
                aria-describedby="helpId" value="{{ old('longitude') }}">
        </div>


        <div class="mb-3">
            <label for="latitude" class="form-label">latitude</label>
            <input type="text" name="latitude" id="latitude" class="form-control  @error('latitude') is_invalid @enderror"
                placeholder="Type your latitude" aria-describedby="helpId" value="{{ old('latitude') }}">
        </div>


        <div class="mb-3">
            <label for="image" class="form-label">Image URL</label>
            <input type="file" accept="images/*" name="image" id="image"
                class="form-control  @error('image') is_invalid @enderror" placeholder="URL or upload your img"
                aria-describedby="helpId">
        </div>

        <div class="mb-3">
            <label for="floor" class="form-label">floor</label>
            <input type="text" name="floor" id="floor" class="form-control  @error('floor') is_invalid @enderror"
                placeholder="Type your floor" aria-describedby="helpId" value="{{ old('floor') }}">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">price</label>
            <input type="text" name="price" id="price" class="form-control  @error('price') is_invalid @enderror"
                placeholder="Type your price" aria-describedby="helpId" value="{{ old('price') }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">description</label>
            <input type="text" name="description" id="description"
                class="form-control  @error('description') is_invalid @enderror" placeholder="Type your description"
                aria-describedby="helpId" value="{{ old('description') }}">
        </div>


        <div class="mb-3">
            <label for="is_visible" class="form-label">is_visible</label>
            <select multiple class="form-select" name="is_visible" id="is_visible">
                <option disabled>Is visible </option>
                <option value="1">si</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="services" class="form-label">services</label>
            <select multiple class="form-select" name="services[]" id="services">
                <option disabled>Select all services</option>

                @foreach ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach

            </select>
        </div>



        <button type="submit" class="btn btn-primary">Add Apartment</button>

    </form>
@endsection
