@extends('layout.main')
@section('style')
    <link href="{{ asset('assets/css/expenses.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
@endsection
@section('content')
    <livewire:expenses />
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script><script>
    $(document).ready(function () {
        $("#myTable").DataTable();
    });
</script>
@endsection
