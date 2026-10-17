@extends('layouts.app')

@section('content')

    <main class="page-transition" style="padding: 120px 0 60px 0; min-height: 80vh;">
        <!-- Header Section -->
        <section class="section text-center">
            <div class="container">
                <h1 class="scroll-reveal" style="font-size: 3rem; color: var(--primary-color);">TISC</h1>
                <p class="scroll-reveal delay-1" style="font-size: 1.1rem; max-width: 700px; margin: 1rem auto; color: var(--text-light);">
                    Technology and Innovation Support Centers
                </p>
            </div>
        </section>

        <!-- TISC Section -->
        <section id="tisc" class="section bg-light">
            <div class="container">
                <div class="tisc-card scroll-reveal">
                    <div class="tisc-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--primary-color);">
                            <path d="M9 18h6"></path>
                            <path d="M10 22h4"></path>
                            <path d="M15.09 14c.18-.98.65-1.74 1.41-2.5A4.65 4.65 0 0 0 12 3a4.65 4.65 0 0 0-4.5 8.5c.76.76 1.23 1.52 1.41 2.5"></path>
                        </svg>
                    </div>
                    <div class="tisc-content">
                        <h2 class="tisc-title">TISC</h2>
                        <h3 class="tisc-subtitle">Technology and Innovation Support Centers</h3>
                        <p class="tisc-text">
                            This program provides innovators with access to local Patent database, high quality technological information and related services via other websites, helping them to exploit their innovative potential and to create, protect, and manage their intellectual property (IP) rights by establishing Technology and Innovation Support Centers in Sri Lanka in collaboration with the World Intellectual Property Organization (WIPO).
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
