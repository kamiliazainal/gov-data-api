<?php

namespace App\Http\Controllers\api;

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

        return $jsonData;
    }

    public function gender()
    {
        $jsonData = Storage::json('population.json');
        $date = Carbon::now()->subYears(10)->format('Y-m-d');

        $collection = collect($jsonData);
        $filteredData = $collection->filter(function($item) use($date) {
            return ($item['date'] >= $date && $item['sex'] != 'both');
        });

        $chartData = [
            'labels' => $filteredData->pluck('sex'),
            'data' => $filteredData->pluck('population'),
        ];

        return response()->json($chartData);
    }
}
