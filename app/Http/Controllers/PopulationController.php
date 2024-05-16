<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PopulationController extends Controller
{
    public function index()
    {
        $jsonData = Storage::json('population.json');

        $date = Carbon::now()->subYears(10)->format('Y-m-d');
        // $collection = collect($jsonData);
        // $filteredData = $collection->filter(function($item) use($date) {
        //     return $item['date'] >= $date;
        // });

        // array_filter automatically created new key. array_values will reset/remove the key
        // $filteredData = array_values(array_filter($jsonData, function ($item) use ($date) {
        //     return ($item['date'] >= $date);
        // }));

        // $response = response()->json($filteredData);
        // dd($response, $filteredData);

        return view('population', compact('jsonData'));
        // return $filteredData;
    }

    public function filterData()
    {}
}
