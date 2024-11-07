@extends('layouts.officer.sidebar')

@section('title', 'Officer Dashboard')

@section('contents')
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">



    <div class="container">
        <div class="main-content">
            <!-- Row for Total Widgets -->
            <div class="stats_container">
                <div class="stat_item total-pengguna">
                    <span class="stat_label">Total Pengguna</span>
                    <span class="stat_value">{{ $totalUsers }}</span>
                </div>
                <div class="stat_item total-ticket">
                    <span class="stat_label">Total Pending</span>
                    <span class="stat_value">{{ $totalPending }}</span>
                </div>
                <div class="stat_item total-laporan-terselesaikan">
                    <span class="stat_label">Total terselesaikan</span>
                    <span class="stat_value">{{ $totalClosed }}</span>
                </div>
            </div>

            <div style="width: 80%; margin: auto;">
                <canvas id="barChart"></canvas>
            </div>


            <div class="report-container">
                @forelse ($tickets as $ticket)
                    <div class="report-item">
                        <i class="bx bx-user profiles"></i>
                        <div class="report-details">
                            <p class="report-title">Dugaan {{ $ticket->title }} dari {{ $ticket->user->name }}</p>
                            <span class="report-date">{{ $ticket->created_at->format('d F Y H:i') }}</span>
                        </div>
                        <button class="btn-report" onclick="window.location=''">Ambil Laporan</button>
                    </div>
                @empty
                    <p>tidak ada</p>
                @endforelse
            </div>

        </div>
    </div>

    <script>
        var ctx = document.getElementById('barChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($totalChart['labels']),
                datasets: [{
                    label: 'totalChart',
                    data: @json($totalChart['data']),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
