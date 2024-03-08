<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In | Hyper - Responsive Bootstrap 4 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .logo_image {
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        .logo_image i {
            font-size: 50px;
            margin-right: 10px;
        }

        .alert {
            position: absolute;
            z-index: 999;
            width: 100vw;
            right: 10px;
            top: 10px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }


        @media (min-width:992px) {
            .space {
                height: 50px
            }

            .alert {
                width: 30vw;
            }
        }
    </style>
    <style>
        .error {
            color: red;
            font-size: 10px;
        }
    </style>

</head>

<body class="authentication-bg pb-0" data-layout-config='{"darkMode":false}'>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Success - </strong> Your information was successfully added.
        </div>
    @endif

    <livewire:signin />

    <!-- bundle -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>

</body>

</html>
