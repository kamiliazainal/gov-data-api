@extends('layouts.guest')

@section('content')
    <table id="myTable" class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2">Gender</th>
                <th class="px-4 py-2">Age</th>
                <th class="px-4 py-2">Ethnicity</th>
                <th class="px-4 py-2">Population</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jsonData as $data)
                <tr>
                    <td class="border px-4 py-2">{{ $data['date'] }}</td>
                    <td class="border px-4 py-2">{{ $data['sex'] }}</td>
                    <td class="border px-4 py-2">{{ $data['age'] }}</td>
                    <td class="border px-4 py-2">{{ $data['ethnicity'] }}</td>
                    <td class="border px-4 py-2">{{ $data['population'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="col-4">
        <canvas id="genderPopulation"></canvas>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endpush
