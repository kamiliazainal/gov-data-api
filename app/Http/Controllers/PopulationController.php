<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class PopulationController extends Controller
{
    public function index()
    {
        // $jsonData = Storage::json('population.json');

        // $perPage = 10;
        // $current_page = LengthAwarePaginator::resolveCurrentPage();
        // $current_page_data = array_slice($jsonData, ($current_page - 1) * $perPage, $perPage);
        // $paginatedJsonData = new LengthAwarePaginator($current_page_data, count($jsonData), $perPage);

        // dd($paginatedJsonData);


        // $chunks = collect($jsonData)->chunk(10);

        // foreach ($chunks as $key => $chunk) {
        //     $chunks[$key] = array_values($chunk->toArray());
        // }

        // $jsonData = $chunks;

        // dd($jsonData);

        // $date = Carbon::now()->subYears(10)->format('Y-m-d');
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

        // return view('population', compact('jsonData'));
        // return $filteredData;
        return view('population');
    }

    public function filterData()
    {}
}
