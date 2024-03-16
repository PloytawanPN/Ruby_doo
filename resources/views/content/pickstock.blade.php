@extends('layout.main')
@section('style')
    <link href="{{ asset('assets/css/stock.css') }}" rel="stylesheet">
@endsection
@section('content')
    <livewire:pickstock />
@endsection
@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modal = document.getElementById("modal");
            var openModalBtn = document.getElementById("openModalBtn");
            var modal_1 = document.getElementById("modal_1");
            var openModalcard = document.getElementsByClassName("card");

            openModalBtn.onclick = function() {
                modal.style.display = "block";
            }

            for (var i = 0; i < openModalcard.length; i++) {
                openModalcard[i].addEventListener("click", function() {
                    modal_1.style.display = "block";
                });
            }

            var closeBtn_1 = document.querySelector("#modal_1 .close_1");
            closeBtn_1.addEventListener("click", function() {
                modal_1.style.display = "none";
            });

            var closeBtn = document.querySelector("#modal .close");
            closeBtn.addEventListener("click", function() {
                modal.style.display = "none";
            });

            window.addEventListener("click", function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
                if (event.target == modal_1) {
                    modal_1.style.display = "none";
                }
            });
        });
    </script>

    <script>
        function clearAlert() {
            // Send an AJAX request to clear the session alert
            fetch('/clear-alert')
                .then(response => response.json())
                .then(data => {
                    console.log(data.message); // Optional: Log the response message
                    // Optionally, you can also remove the alert message from the DOM
                    document.querySelector('.alert').remove();
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
