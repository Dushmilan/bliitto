<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BLII-TTO | University of Peradeniya')</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
@include('partials.nav')

@yield('content')

@include('partials.footer')
<script src="{{ asset('script.js') }}"></script>
</body>
</html>
