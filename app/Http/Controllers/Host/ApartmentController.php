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
        $user = Auth::id();
        if ($request->has('services')) {
            $request->validate([
                'services' => ['nullable', 'exists:services,id']
            ]);
        }

        $validate_data = $request->validate([
            'title' => ['required', 'unique:apartments', 'max:200'],
            'rooms' => ['required'],
            'bathrooms' => ['required'],
            'beds' => ['required'],
            'squared_meters' => ['required'],
            'address' => ['required'],
            'longitude' => ['required'],
            'latitude' => ['required'],
            'image' => ['required', 'image', 'max:500'],
            'is_visible' => ['required'],
            'floor' => ['nullable'],
            'price' => ['nullable'],
            'description' => ['nullable'],
        ]);




        if ($request->file('image')) {

            $image_path = Storage::put('apartment_image', $request->file('image'));


            $validate_data['image'] = $image_path;
        }


        $validate_data['slug'] = Str::slug($validate_data['title']);
        $validate_data = Arr::add($validate_data, 'user_id', "$user");
        $apartment = Apartment::create($validate_data);


        /*   $apartment->user_id = Auth::id(); */

        if ($request->has('services')) {
            $request->validate([
                'services' => ['nullable', 'exists:services,id']
            ]);
            $apartment->services()->attach($request->apartments);
        }

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

        return view('host.apartments.show', compact('apartment'));
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

        if (Auth::id() === $apartment->user_id) {

            $validate_data = $request->validate([
                'title' => ['required', Rule::unique('apartments')->ignore($apartment->id), 'max:200'],
                'rooms' => ['required'],
                'bathrooms' => ['required'],
                'beds' => ['required'],
                'squared_meters' => ['required'],
                'address' => ['required'],
                'longitude' => ['required'],
                'latitude' => ['required'],
                'image' => ['required', 'image', 'max:500'],
                'is_visible' => ['required'],
                'floor' => ['nullable'],
                'price' => ['nullable'],
                'description' => ['nullable'],
            ]);

            if ($request->file('image')) {

                Storage::delete($apartment->image);

                $image_path = $request->file('image')->store('apartment_image');

                $validated['image'] = $image_path;
            }

            if ($request->has('services')) {
                $request->validate([
                    'services' => ['nullable', 'exists:services,id']
                ]);
                $apartment->services()->sync($request->apartments);
            }

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
