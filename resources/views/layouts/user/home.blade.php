@extends('layouts.user.sidebar')

@section('title', 'User Dashboard')

@section('contents')

<link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">

<div class="promo-section">
    <button class="close-button" onclick="this.parentElement.style.display='none';">&times;</button>
    <h3>Special Promo for TravelEase!</h3>
    <div class="bali-promo">
        <h2>Explore Bali!</h2>
        <p>Book your dream vacation in Bali and get an additional 10% off. Use code <strong>BALI10</strong> at checkout!</p>
        <img src="{{ asset('assets/img/bali.jpg') }}" alt="" />
    </div>
</div>


<div class="container5">
    <h1>Laporan Dalam Antrean</h1>
    <br>
    @forelse ($tickets as $ticket)
        <div class="report-item">
            <div class="report-details">
                <p class="report-title">Ticket {{ $ticket->title }} From {{ $ticket->user->name }}</p>
                <p class="report-description">Description: {{ $ticket->description }}</p>
                <span class="report-date">{{ $ticket->created_at->format('d F Y H:i') }}</span> 
            </div>
        </div>
    @empty
        <p>Tidak ada laporan dalam antrean.</p>
    @endforelse
    <hr>
</div>


@include('chatbot.chatbot')
    {{-- @include('chatbot.chatbot') --}}
@endsection
