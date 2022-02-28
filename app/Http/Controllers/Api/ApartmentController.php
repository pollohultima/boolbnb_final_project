<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApartmentResource;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Apartment::all();
        return ApartmentResource::collection(Apartment::has('sponsors')->with(['sponsors'])->get());
        /* return ApartmentResource::collection(Apartment::all()->keyBy->slug); */
    }

    public function advanced_search(Request $request)
    {

        if ($request->has('address')) {
            $address_input = $request->all()['address'];
            $get_coordinate = Http::withOptions([
                'verify' => false,
            ])
                ->get("https://api.tomtom.com/search/2/geocode/" . $address_input . ".json?key=L5vJ5vBEzTCuKlxTimT8J5hFnGD9TRXs");
            $get_lat_long = $get_coordinate->json()['results'][0]['position'];
            $lat_from = $get_lat_long['lat'];
            $lon_from = $get_lat_long['lon'];
        }

        if ($request->has('beds')) {
            $beds =  $request->all()['beds'];
        } else {
            $beds = 0;
        }

        if ($request->has('rooms')) {
            $rooms =  $request->all()['rooms'];
        } else {
            $rooms = 0;
        }

        if ($request->has('services')) {
            $services =  $request->all()['services'];
        } else {
            $services = 0;
        }

        if ($request->has('km_radius')) {
            $km_radius =  $request->all()['km_radius'];
        } else {
            $km_radius = 0;
        }

        $apartment_list =
            /* ApartmentResource::collection(Apartment::with(['services'])->get()); */
            Apartment::with('services');
        if ($rooms > 0) {
            $apartment_list = $apartment_list->where('rooms', '>=', $rooms);
        }
        if ($beds > 0) {
            $apartment_list = $apartment_list->where('beds', '>=', $beds);
        }

        if ($services != '') {
            $services = explode(",", $services);
        }
        if ($services != 0) {
            foreach ($services as $key => $value) {
                $apartment_list =  $apartment_list->whereHas('services', function ($q) use ($value, $key) {

                    $q->where('id', '=', $value);
                });
            }
        }
        $apartment_list = ApartmentResource::collection($apartment_list->get());
        function haversineGreatCircleDistance(
            $latitudeFrom,
            $longitudeFrom,
            $latitudeTo,
            $longitudeTo,
            $earthRadius = 6371000
        ) {
            // convert from degrees to radians
            $latFrom = deg2rad($latitudeFrom);
            $lonFrom = deg2rad($longitudeFrom);
            $latTo = deg2rad($latitudeTo);
            $lonTo = deg2rad($longitudeTo);

            $latDelta = $latTo - $latFrom;
            $lonDelta = $lonTo - $lonFrom;

            $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
            return $angle * $earthRadius;
        }

        foreach ($apartment_list as $key => $p) {
            $get_radius_from_parameters = haversineGreatCircleDistance($p->latitude, $p->longitude, $lat_from, $lon_from) / 1000;
            if ($km_radius > 0) {
                if ($get_radius_from_parameters > $km_radius) {
                    unset($apartment_list[$key]);
                } else {
                    $apartment_list[$key]['distance'] = $get_radius_from_parameters;
                };
            }
        }

        $sorted = $apartment_list->sortBy('distance');

        return $sorted->values()->all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sponsored()
    {
        // return Apartment::all();


    }
    /* 
    public function get_real_address(Request $request)
    {
        ddd($request->all());
        $get_coordinate = Http::withOptions([
            'verify' => false,
        ])
            ->get("https://api.tomtom.com/search/2/geocode/" . $address_input . ".json?key=L5vJ5vBEzTCuKlxTimT8J5hFnGD9TRXs");
    }
 */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return $apartment;
    }
}
