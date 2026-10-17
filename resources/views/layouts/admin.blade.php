<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin') · BLII-TTO</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <link rel="stylesheet" href="{{ asset('admin.css') }}">
</head>
<body class="admin-body">
@auth
    <header class="admin-header">
        <div class="container admin-header-inner">
            <a href="{{ route('admin.dashboard') }}" class="admin-brand">
                <img src="{{ asset('uop-logo-transparent.png') }}" alt="" style="height:32px;width:auto;">
                <span>BLII-TTO <strong>Admin</strong></span>
            </a>
            <nav class="admin-nav">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="admin-logout">Log out</button>
                </form>
            </nav>
        </div>
    </header>
@endauth

<main class="admin-main">
    <div class="container">
        @if (session('status'))
            <div class="admin-flash">{{ session('status') }}</div>
        @endif

        @yield('content')
    </div>
</main>
</body>
</html>
