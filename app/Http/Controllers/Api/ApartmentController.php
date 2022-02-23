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
        return ApartmentResource::collection(Apartment::has('sponsors')->with(['sponsors'])->paginate(5));
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

        $apartment_list = /* Apartment::select('*')
            ->join('apartment_service', function($join)
            {
                $join->on('apartment_service.apartment_id', '=', 'apartments.id');
            })
            
            ->selectRaw('( 6371 * acos( cos( radians(?) ) *
                               cos( radians( latitude ) )
                               * cos( radians( longitude ) - radians(?)
                               ) + sin( radians(?) ) *
                               sin( radians( latitude ) ) )
                             ) AS distance', [$lat_from, $lon_from, $lat_from])
                             ->orderByRaw('distance')
            ->havingRaw("distance < ?", [$km_radius])
            ->get(); */


            /* Apartment::with(['services','sponsors']) ->selectRaw('( 6371 * acos( cos( radians(?) ) *
                               cos( radians( latitude ) )
                               * cos( radians( longitude ) - radians(?)
                               ) + sin( radians(?) ) *
                               sin( radians( latitude ) ) )
                             ) AS distance', [$lat_from, $lon_from, $lat_from])
                             ->orderByRaw('distance')
            ->havingRaw("distance < ?", [$km_radius])
            
          
        
          ->get(); */


            ApartmentResource::collection(Apartment::with(['services', 'sponsors'])->get());


        if ($rooms > 0) {
            $apartment_list = $apartment_list->where('rooms', '>=', $rooms);
        }
        if ($beds > 0) {
            $apartment_list = $apartment_list->where('beds', '>=', $beds);
        }
        /* if ($services > 0) {
            $apartment_list = $apartment_list->where('services.id', '=', $services);
        } */

        /*    $apartment_list->filter(function ($apartament) use ($services) {
            if (isset($apartament) && $apartament->services[0]->id = $services) {

                return $apartament;
            }
        });


        $test = [1, 3];

        $apartment_list =
            Apartment::with(['services', 'sponsors'])->whereHas('services', function ($q) use ($test) {
                foreach ($test as $value) {
                    $q->where('id', '=', $value);
                }
            })->get(); */

        $apartment_list =
            ApartmentResource::collection($apartment_list);
        /*  function haversineGreatCircleDistance(
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

            $current_km_by_coordinates = haversineGreatCircleDistance($p->latitude, $p->longitude, $lat_from, $lon_from) / 1000;

            if ($km_radius > 0) {
                if ($current_km_by_coordinates > $km_radius) {
                    unset($apartment_list[$key]);
                }
                else{
                  $apartment_list[$key]['distance']= $current_km_by_coordinates;
                }
            }
        }  */

        return $apartment_list;
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
