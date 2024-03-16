@extends('layout.main')
@section('content')
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">
    <livewire:dashboard />
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @stack('js')
@endsection
