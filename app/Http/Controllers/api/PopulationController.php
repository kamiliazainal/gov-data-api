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
        $filteredData = $collection->filter(function ($item) use ($date) {
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
        $filteredData = $collection->filter(function ($item) use ($date) {
            return ($item['date'] >= $date && $item['sex'] != 'both');
        });

        $groupedData = $filteredData->groupBy(function ($item) {
            return Carbon::parse($item['date'])->format('Y');
        });

        $years = [];
        $maleCounts = [];
        $femaleCounts = [];

        foreach ($groupedData as $year => $data) {
            $years[] = $year;
            $maleCounts[] = $data->where('sex', 'male')->count();
            $femaleCounts[] = $data->where('sex', 'female')->count();
        }

        $chartData = [
            'labels' => $years,
            'males' => $maleCounts,
            'females' => $femaleCounts
        ];

        return response()->json($chartData);
    }
}
