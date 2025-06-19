<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>E-VOTING</title>

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('majestic') }}/images/favicon.png" />

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #countdown {
            text-align: center;
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .countdown-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px auto;
            font-family: Arial, sans-serif;
            font-size: 48px;
        }

        .countdown-item {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 0 10px;
            color: #fff;
            background-color: #333;
            border-radius: 10px;
            width: 150px;
            height: 150px;
        }

        .countdown-value {
            font-size: 64px;
            font-weight: bold;
        }

        .countdown-label {
            font-size: 24px;
            margin-top: 10px;
        }

        .flip-clock {
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            font-size: 48px;
            height: 100px;
        }

        .flip-clock-digit {
            position: relative;
            width: 60px;
            height: 100%;
            margin: 0 5px;
            background-color: #222;
            color: #fff;
            text-align: center;
            transition: transform 0.5s ease;
        }

        .flip-clock-digit .flip-clock-upper,
        .flip-clock-digit .flip-clock-lower {
            position: absolute;
            left: 0;
            right: 0;
            margin: 0 auto;
            width: 100%;
            height: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 48px;
        }

        .flip-clock-digit .flip-clock-upper {
            top: 0;
            transform: rotateX(0deg);
            transition: transform 0.5s ease;
        }

        .flip-clock-digit .flip-clock-lower {
            bottom: 0;
            transform: rotateX(90deg);
            transition: transform 0.5s ease;
        }

        .flip-clock-digit.flip-clock-digit-flip .flip-clock-upper {
            transform: rotateX(-90deg);
        }

        .flip-clock-digit.flip-clock-digit-flip .flip-clock-lower {
            transform: rotateX(0deg);
        }
    </style>

</head>

<body>
