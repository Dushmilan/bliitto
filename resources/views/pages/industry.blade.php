@extends('layouts.app')

@section('content')

    <main class="page-transition" style="padding: 120px 0 60px 0; min-height: 80vh;">
        <!-- Header Section -->
        <section class="section text-center">
            <div class="container">
                <h1 class="scroll-reveal" style="font-size: 3rem; color: var(--primary-color);">For <span class="highlight">Industry</span></h1>
                <p class="scroll-reveal delay-1" style="font-size: 1.1rem; max-width: 700px; margin: 1rem auto; color: var(--text-light);">
                    Partner with the University of Peradeniya to access cutting-edge technologies, expertise, and research innovations.
                </p>
            </div>
        </section>

        <!-- Industry Directory -->
        <section class="section bg-light">
            <div class="container">
                <div class="grid-3-col scroll-reveal delay-1" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                    
                    <!-- Patented Technologies Card -->
                    <a href="{{ route('patented-technologies') }}" style="text-decoration: none; color: inherit; display: block;">
                        <div class="card" style="padding: 2.5rem; text-align: center; border-bottom: 4px solid var(--secondary-color); height: 100%; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <div style="font-size: 3rem; margin-bottom: 1.5rem;">🔬</div>
                            <h2 style="color: var(--primary-color); margin-bottom: 1rem; font-size: 1.5rem;">Patented Technologies</h2>
                            <p style="color: var(--text-main); font-size: 0.95rem; line-height: 1.6;">
                                Explore our catalogue of patented technologies available for licensing and commercialization.
                            </p>
                            <span class="btn btn-primary" style="margin-top: 1.5rem; display: inline-block;">Learn More</span>
                        </div>
                    </a>

                    <!-- Technology Know-How Card -->
                    <a href="{{ route('technology-know-how') }}" style="text-decoration: none; color: inherit; display: block;">
                        <div class="card" style="padding: 2.5rem; text-align: center; border-bottom: 4px solid var(--secondary-color); height: 100%; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <div style="font-size: 3rem; margin-bottom: 1.5rem;">⚙️</div>
                            <h2 style="color: var(--primary-color); margin-bottom: 1rem; font-size: 1.5rem;">Technology Know-How</h2>
                            <p style="color: var(--text-main); font-size: 0.95rem; line-height: 1.6;">
                                Discover specialized technical expertise and proprietary know-how tailored for industry solutions.
                            </p>
                            <span class="btn btn-primary" style="margin-top: 1.5rem; display: inline-block;">Learn More</span>
                        </div>
                    </a>

                    <!-- Researchers Card -->
                    <a href="{{ route('researchers') }}" style="text-decoration: none; color: inherit; display: block;">
                        <div class="card" style="padding: 2.5rem; text-align: center; border-bottom: 4px solid var(--secondary-color); height: 100%; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <div style="font-size: 3rem; margin-bottom: 1.5rem;">👨‍🔬</div>
                            <h2 style="color: var(--primary-color); margin-bottom: 1rem; font-size: 1.5rem;">Researchers</h2>
                            <p style="color: var(--text-main); font-size: 0.95rem; line-height: 1.6;">
                                Connect with our world-class researchers and explore their diverse fields of expertise.
                            </p>
                            <span class="btn btn-primary" style="margin-top: 1.5rem; display: inline-block;">Learn More</span>
                        </div>
                    </a>

                </div>
            </div>
        </section>
    </main>

    <style>
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
    </style>

@endsection
