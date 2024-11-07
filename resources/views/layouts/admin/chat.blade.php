    @extends('layouts.admin.sidebar')

    @section('title', 'Admin Dashboard')


    @section('contents')
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">



        <div class="container">
            <div class="main-content">
                <!-- Row for Total Widgets -->


            </div>
        </div>


        <script src="{{ asset('assets/js/dashboard.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endsection
