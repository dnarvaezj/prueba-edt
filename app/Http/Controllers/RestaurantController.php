<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index () {

        $restaurantData = Restaurant::all();

        return view('welcome', compact('restaurantData'));
    }

    public function loadCsv (Request $request) {

        $file = $request->file('csvFile');
        $openFile = fopen($file, 'r');

        try {
            $i = 0;
            while (($line = fgetcsv($openFile, 4096)) !== false) {
                if ($i !== 0) {
                    $restaurant = new Restaurant();
                    $restaurant->rating = $line[1];
                    $restaurant->name = $line[2];
                    $restaurant->site = $line[3];
                    $restaurant->email = $line[4];
                    $restaurant->phone = $line[5];
                    $restaurant->street = $line[6];
                    $restaurant->city = $line[7];
                    $restaurant->state = $line[8];
                    $restaurant->lat = $line[9];
                    $restaurant->lng = $line[10];
                    $restaurant->save();
                }
                $i++;
            }

            $response = response()->json([
                'status' => 'success',
                'message' => 'CSV loaded'
            ], 200);

        } catch (\Throwable $th) {
            $response = response()->json([
                'status' => 'failed',
                'message' => 'Error in the CSV load: ',
                'error' => strval($th)
            ], 400);
        }
        

        if ($request->is('api/*')) {
            return $response;
        } else {
            return back();
        }

    }

    public function create (Request $request) {

        $restaurant = new Restaurant();
        $restaurant->rating = $request->rating;
        $restaurant->name = $request->name;
        $restaurant->site = $request->site;
        $restaurant->email = $request->email;
        $restaurant->phone = $request->phone;
        $restaurant->street = $request->street;
        $restaurant->city = $request->city;
        $restaurant->state = $request->state;
        $restaurant->lat = $request->lat;
        $restaurant->lng = $request->lng;
        $restaurant->save();

        if ($request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => 'Restaurant created'
            ], 200);
        } else {
            return back();
        }
    }

    public function update (Request $request, $id) {

        $restaurant = Restaurant::find($id);
        $restaurant->rating = $request->rating;
        $restaurant->name = $request->name;
        $restaurant->site = $request->site;
        $restaurant->email = $request->email;
        $restaurant->phone = $request->phone;
        $restaurant->street = $request->street;
        $restaurant->city = $request->city;
        $restaurant->state = $request->state;
        $restaurant->lat = $request->lat;
        $restaurant->lng = $request->lng;
        $restaurant->save();

        if ($request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => 'Restaurant updated'
            ], 200);
        } else {
            return back();
        }
    }

    public function delete (Request $request, $id) {

        $restaurant = Restaurant::find($id);
        $restaurant->delete();

        if ($request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => 'Restaurant deleted'
            ], 200);
        } else {
            return back();
        }
    }
}
