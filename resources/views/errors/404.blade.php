@extends('layouts.app')

@section('content')

    <main style="padding: 140px 0 80px 0; min-height: 60vh;">
        <div class="container text-center">
            <h1 style="font-size: 4rem; margin-bottom: 0.5rem;"><span class="highlight">404</span></h1>
            <h2 style="margin-top: 0;">Page Not Found</h2>
            <p>The page you are looking for does not exist or may have been moved.</p>
            <a href="{{ route('home') }}" class="btn btn-secondary mt-4">Return Home</a>
        </div>
    </main>

@endsection
