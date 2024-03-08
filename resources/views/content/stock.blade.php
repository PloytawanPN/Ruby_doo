@extends('layout.main')
@section('style')
    <link href="{{ asset('assets/css/stock.css') }}" rel="stylesheet">
@endsection
@section('content')
    <livewire:stock />
@endsection
@section('script')
    <script>
        var modal = document.getElementById("modal");
        var modal_1 = document.getElementById("modal_1");
        var openModalBtn = document.getElementById("openModalBtn");
        var openModalcard = document.getElementsByClassName("card");
        var closeBtn = document.querySelector("#modal .close");
        var closeBtn_1 = document.querySelector("#modal_1 .close_1");

        openModalBtn.onclick = function() {
            modal.style.display = "block";
        }

        closeBtn.onclick = function() {
            modal.style.display = "none";
        }

        for (var i = 0; i < openModalcard.length; i++) {
            openModalcard[i].onclick = function() {
                modal_1.style.display = "block";
            }
        }

        closeBtn_1.onclick = function() {
            modal_1.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
            if (event.target == modal_1) {
                modal_1.style.display = "none";
            }
        }
    </script>
@endsection
