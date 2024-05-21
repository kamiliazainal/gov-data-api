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
    </table>

    <div class="col-4">
        <canvas id="genderPopulation"></canvas>
    </div>

    <div class="col-4">
        <canvas id="dateGender"></canvas>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                ajax: {
                    url: '/api/population',
                    dataSrc: ''
                },
                columns: [
                    { data: 'date' },
                    { data: 'sex' },
                    { data: 'age' },
                    { data: 'ethnicity' },
                    { data: 'population' }
                ],
                deferRender: true
            });
        });
    </script>
@endpush
