<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

use function GuzzleHttp\json_encode;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Auth::user()->apartments()->orderByDesc('id')->paginate(6);

        return view('host.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();

        return view('host.apartments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $address_input = urlencode($request->all()['address']);
        $get_coordinate = Http::withOptions([
            'verify' => false,
        ])
            ->get("https://api.tomtom.com/search/2/geocode/" . $address_input . ".json?key=L5vJ5vBEzTCuKlxTimT8J5hFnGD9TRXs");


        if ($request['address'] != null && $get_coordinate->json()['results'] == null) {
            $request['address'] = null;
        }

        $validate_data = $request->validate([
            'title' => ['required', 'unique:apartments', 'max:200'],
            'rooms' => ['required', 'numeric'],
            'bathrooms' => ['required', 'numeric'],
            'beds' => ['required', 'numeric'],
            'squared_meters' => ['required', 'numeric'],
            'address' => ['required', 'min:5'],
            'image' => ['required', 'image', 'max:500'],
            'is_visible' => ['required'],
            'floor' => ['nullable', 'numeric'],
            'price' => ['nullable', 'numeric'],
            'description' => ['nullable'],
        ]);




        $get_lat_long = $get_coordinate->json()['results'][0]['position'];

        $user = Auth::id();
        if ($request->has('services')) {
            $request->validate([
                'services' => ['nullable', 'exists:services,id']
            ]);
        }

        if ($request->file('image')) {

            $image_path = Storage::put('apartment_image', $request->file('image'));

            $validate_data['image'] = $image_path;
        }


        $validate_data['slug'] = Str::slug($validate_data['title']);
        $validate_data = Arr::add($validate_data, 'user_id', "$user");
        $validate_data['longitude'] = $get_lat_long['lon'];
        $validate_data['latitude'] = $get_lat_long['lat'];
        $apartment = Apartment::create($validate_data);


        /*   $apartment->user_id = Auth::id(); */


        $request->validate([
            'services' => ['required', 'exists:services,id']
        ]);
        $apartment->services()->attach($request->services);


        return redirect()->route('host.apartments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        $lati = $apartment['latitude'];

        $long = $apartment['longitude'];




        return view('host.apartments.show', compact('apartment', 'lati', 'long'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $services = Service::all();

        if (Auth::id() === $apartment->user_id) {
            return view('host.apartments.edit', compact('apartment', 'services'));
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {

        $address_input = urlencode($request->all()['address']);
        $get_coordinate = Http::withOptions([
            'verify' => false,
        ])
            ->get("https://api.tomtom.com/search/2/geocode/" . $address_input . ".json?key=L5vJ5vBEzTCuKlxTimT8J5hFnGD9TRXs");


        if ($request['address'] != null && $get_coordinate->json()['results'] == null) {
            $request['address'] = null;
        }


        if (Auth::id() === $apartment->user_id) {

            $validate_data = $request->validate([
                'title' => ['required', Rule::unique('apartments')->ignore($apartment->id), 'max:200'],
                'rooms' => ['required', 'numeric'],
                'bathrooms' => ['required', 'numeric'],
                'beds' => ['required', 'numeric'],
                'squared_meters' => ['required', 'numeric'],
                'address' => ['required', ' min:5'],
                'image' => ['nullable', 'image', 'max:500'],
                'is_visible' => ['required'],
                'floor' => ['nullable', 'numeric'],
                'price' => ['nullable', 'numeric'],
                'description' => ['nullable'],
            ]);

            $get_lat_long = $get_coordinate->json()['results'][0]['position'];


            if ($request->file('image')) {

                Storage::delete($apartment->image);

                $image_path = Storage::put('apartment_image', $request->file('image'));

                $validate_data['image'] = $image_path;
            }



            $request->validate([
                'services' => ['required', 'exists:services,id']
            ]);
            $apartment->services()->sync($request->services);


            $validate_data['slug'] = Str::slug($validate_data['title']);
            $validate_data['latitude'] = $get_lat_long['lat'];
            $validate_data['longitude'] = $get_lat_long['lon'];

            $apartment->update($validate_data);

            return redirect()->route('host.apartments.index');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)

    {

        if (Auth::id() === $apartment->user_id) {

            $apartment->delete();
            return redirect()->route('host.apartments.index');
        } else {
            abort(403);
        }
    }
}
