@extends('layouts.guest')

@section('content')
    <table id="myTable" class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Position</th>
                <th class="px-4 py-2">Office</th>
                <th class="px-4 py-2">Age</th>
                <th class="px-4 py-2">Start date</th>
                <th class="px-4 py-2">Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border px-4 py-2">Tiger Nixon</td>
                <td class="border px-4 py-2">System Architect</td>
                <td class="border px-4 py-2">Edinburgh</td>
                <td class="border px-4 py-2">61</td>
                <td class="border px-4 py-2">2011/04/25</td>
                <td class="border px-4 py-2">$320,800</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Garrett Winters</td>
                <td class="border px-4 py-2">Accountant</td>
                <td class="border px-4 py-2">Tokyo</td>
                <td class="border px-4 py-2">63</td>
                <td class="border px-4 py-2">2011/07/25</td>
                <td class="border px-4 py-2">$170,750</td>
            </tr>
        </tbody>
    </table>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endpush
