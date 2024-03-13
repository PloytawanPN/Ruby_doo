@extends('layout.main')
@section('style')
    <link href="{{ asset('assets/css/orderlist.css') }}" rel="stylesheet">
@endsection
@section('content')
    <livewire:orderlist />
@endsection
