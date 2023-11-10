<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FuelPriceController extends Controller
{
    /**
     * Create global variable $currentDate
     */
    protected $currentDate, $url, $id;

    public function __construct()
    {
        $this->currentDate = Carbon::now()->subMonths(3)->format('Y-m-d');
        $this->url = 'https://api.data.gov.my/data-catalogue';
        $this->id = 'fuelprice';
    }

    public function index()
    {
        $request = Http::get($this->url, [
            'id' => $this->id,
            'date_start' => $this->currentDate.'@date',
            'sort' => 'date'
        ]);

        $response = $request->collect();
        $response = $response->filter(function($item) {
            return $item['series_type'] != 'change_weekly';
        });
    }

    public function ron95()
    {
        $request = Http::get($this->url, [
            'id' => $this->id,
            'include' => 'ron95,date,series_type',
            'date_start' => $this->currentDate.'@date',
            'sort' => 'date'
        ]);

        $response = $request->collect();

        $filteredData = $response->filter(function($item) {
            return $item['series_type'] != 'change_weekly';
        });

        $chartData = [
            'labels' => $filteredData->pluck('date'),
            'data' => $filteredData->pluck('ron95'),
        ];

        return response()->json($chartData);
    }

    public function ron97()
    {
        $request = Http::get($this->url, [
            'id' => $this->id,
            'include' => 'ron97,date,series_type',
            'date_start' => $this->currentDate.'@date',
            'sort' => 'date'
        ]);

        $response = $request->collect();

        $filteredData = $response->filter(function($item) {
            return $item['series_type'] != 'change_weekly';
        });

        $chartData = [
            'labels' => $filteredData->pluck('date'),
            'data' => $filteredData->pluck('ron97'),
        ];

        return response()->json($chartData);
    }

    public function diesel()
    {
        $request = Http::get($this->url, [
            'id' => $this->id,
            'include' => 'diesel,date,series_type',
            'date_start' => $this->currentDate.'@date',
            'sort' => 'date'
        ]);

        $response = $request->collect();

        $filteredData = $response->filter(function($item) {
            return $item['series_type'] != 'change_weekly';
        });

        $chartData = [
            'labels' => $filteredData->pluck('date'),
            'data' => $filteredData->pluck('diesel'),
        ];

        return response()->json($chartData);
    }

}
