@extends('layouts.app')

@section('content')

    <main class="page-transition" style="padding: 120px 0 60px 0; min-height: 80vh;">
        <!-- Header Section -->
        <section class="section text-center">
            <div class="container">
                <h1 class="scroll-reveal" style="font-size: 3rem; color: var(--primary-color);">Our <span class="highlight">Researchers</span></h1>
                <p class="scroll-reveal delay-1" style="font-size: 1.1rem; max-width: 700px; margin: 1rem auto; color: var(--text-light);">
                    Directory of our world-class researchers and their fields of expertise.
                </p>
            </div>
        </section>

        <!-- Content Section -->
        <section id="researchers" class="section bg-light">
            <div class="container">
                <div class="modern-placeholder scroll-reveal delay-1">
                    <div class="placeholder-icon">👨‍🔬</div>
                    <h2 class="placeholder-title">Our Researchers</h2>
                    <p class="placeholder-text">A comprehensive directory of our world-class researchers and their fields of expertise will be updated soon.</p>
                </div>
            </div>
        </section>
    </main>

@endsection
