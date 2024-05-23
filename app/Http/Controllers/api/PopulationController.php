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
            return ($item['date'] >= $date && $item['age'] != 'overall' && $item['sex'] != 'both');
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
            return ($item['date'] >= $date && $item['age'] != 'overall' && $item['sex'] != 'both');
        });

        $groupedData = $filteredData->groupBy(function ($item) {
            return Carbon::parse($item['date'])->format('Y');
        });

        $years = [];
        $maleCounts = [];
        $femaleCounts = [];

        foreach ($groupedData as $year => $data) {
            $years[] = $year;
            $maleCounts[] = $data->where('sex', 'male')->sum('population');
            $femaleCounts[] = $data->where('sex', 'female')->sum('population');
        }

        $chartData = [
            'labels' => $years,
            'males' => $maleCounts,
            'females' => $femaleCounts
        ];

        return response()->json($chartData);
    }

    public function dateGenderRace()
    {
        $jsonData = $this->jsonData;

        $date = Carbon::now()->subYears(10)->format('Y-m-d');
        $collection = collect($jsonData);
        $filteredData = $collection->filter(function ($item) use ($date) {
            return ($item['date'] >= $date && $item['age'] != 'overall' && $item['sex'] != 'both' && $item['ethnicity'] != 'overall');
        });

        $groupedData = $filteredData->groupBy(function ($item) {
            return Carbon::parse($item['date'])->format('Y');
        });

        $years = [];
        $maleMalayCounts = [];
        $femaleMalayCounts = [];
        $maleBumiCounts = [];
        $femaleBumiCounts = [];
        $maleIndianCounts = [];
        $femaleIndianCounts = [];
        $maleChineseCounts = [];
        $femaleChineseCounts = [];
        $maleOthersCounts = [];
        $femaleOthersCounts = [];

        foreach ($groupedData as $year => $data) {
            $years[] = $year;
            $maleMalayCounts[] = $data->where('sex', 'male')->where('ethnicity', 'bumi_malay')->sum('population');
            $femaleMalayCounts[] = $data->where('sex', 'female')->where('ethnicity', 'bumi_malay')->sum('population');
            $maleBumiCounts[] = $data->where('sex', 'male')->where('ethnicity', 'bumi_other')->sum('population');
            $femaleBumiCounts[] = $data->where('sex', 'female')->where('ethnicity', 'bumi_other')->sum('population');
            $maleIndianCounts[] = $data->where('sex', 'male')->where('ethnicity', 'indian')->sum('population');
            $femaleIndianCounts[] = $data->where('sex', 'female')->where('ethnicity', 'indian')->sum('population');
            $maleChineseCounts[] = $data->where('sex', 'male')->where('ethnicity', 'chinese')->sum('population');
            $femaleChineseCounts[] = $data->where('sex', 'female')->where('ethnicity', 'chinese')->sum('population');
            $maleOthersCounts[] = $data->where('sex', 'male')->whereIn('ethnicity', ['other_citizen','other_noncitizen','other'])->sum('population');
            $femaleOthersCounts[] = $data->where('sex', 'female')->whereIn('ethnicity', ['other_citizen','other_noncitizen','other'])->sum('population');
        }

        $chartData = [
            'labels' => $years,
            'malesMalay' => $maleMalayCounts,
            'femalesMalay' => $femaleMalayCounts,
            'malesBumi' => $maleBumiCounts,
            'femalesBumi' => $femaleBumiCounts,
            'malesIndian' => $maleIndianCounts,
            'femalesIndian' => $femaleIndianCounts,
            'malesChinese' => $maleChineseCounts,
            'femalesChinese' => $femaleChineseCounts,
            'malesOthers' => $maleOthersCounts,
            'femalesOthers' => $femaleOthersCounts,
        ];

        return response()->json($chartData);
    }
}
