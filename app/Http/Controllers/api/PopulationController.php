<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PopulationController extends Controller
{
    private $jsonData;

    public function __construct()
    {
        $this->jsonData = Storage::json('population.json');
    }

    public function index()
    {
        $jsonData = $this->jsonData;
        // $jsonData = Storage::json('population.json');

        // $date = Carbon::now()->subYears(10)->format('Y-m-d');
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
        $jsonData = $this->jsonData;
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

    public function dateGender()
    {
        $jsonData = $this->jsonData;

        $date = Carbon::now()->subYears(10)->format('Y-m-d');
        $collection = collect($jsonData);
        $filteredData = $collection->filter(function($item) use($date) {
            return ($item['date'] >= $date && $item['sex'] != 'both');
        });

        $female = $filteredData->pluck('sex')->filter(function($item){
            return ($item == 'female');
        });

        $male = $filteredData->pluck('sex')->filter(function($item){
            return ($item == 'male');
        });

        $keys = $filteredData->pluck('date')->toArray();
        // $values = $filteredData->pluck('sex')->toArray();
        $mergedFemale = array_combine($keys, $female->toArray());
        $mergedMale = array_combine($keys, $male->toArray());

        dd($mergedFemale, $mergedMale);

        $chartData = [
            'labels' => $mergedArrays,
            'data' => $filteredData->pluck('date'),
        ];
        return response()->json($chartData);
    }
}
