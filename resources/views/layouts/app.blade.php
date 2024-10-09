<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/apps/favicon.ico') }}">
    <title>Event Reminder</title>

    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <style>
        body {
            background-color: #f7f7f7;
        }

        .header {
            margin-top: 20px;
            background: url('{{ asset('images/remainder.jpg') }}') no-repeat center center;
            background-size: cover;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }

        .poll-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .poll-title,
        h4 {
            font-size: 1.5rem;
            color: #475563;
        }

        .poll-option {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .option-label {
            width: 150px;
            text-align: left;
            color: #283441;
            font-size: 1rem;
        }

        .progress-container {
            width: 70%;
            margin-left: 10px;
        }

        .progress {
            background-color: #4d6b8a;
            border-radius: 10px;
            height: 20px;
        }

        .progress-bar {
            background-color: #44051a;
            height: 100%;
            color: white;
            text-align: right;
            padding-right: 10px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    @yield('content')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Perfect Scrollbar JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.3/perfect-scrollbar.min.js"></script>

    <!-- Smooth Scrollbar JS -->
    <script src="https://cdn.jsdelivr.net/npm/smooth-scrollbar@8.5.4/dist/smooth-scrollbar.js"></script>

    <!-- Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

   

    @yield('scripts')
</body>

</html>
