@extends('layouts.app')

@section('content')

    <main class="page-transition" style="padding: 120px 0 60px 0; min-height: 80vh;">
        <!-- Header Section -->
        <section class="section text-center">
            <div class="container">
                <h1 class="scroll-reveal" style="font-size: 3rem; color: var(--primary-color);">Our <span class="highlight">Services</span></h1>
                <p class="scroll-reveal delay-1" style="font-size: 1.1rem; max-width: 700px; margin: 1rem auto; color: var(--text-light);">
                    Explore the various services provided by BLII-TTO to support innovation, incubation, and technology transfer at the University of Peradeniya.
                </p>
            </div>
        </section>

        <!-- Services Directory -->
        <section class="section bg-light">
            <div class="container">
                <div class="grid-2-col scroll-reveal delay-1">
                    
                    <!-- TISC Card -->
                    <a href="{{ route('tisc') }}" style="text-decoration: none; color: inherit; display: block;">
                        <div class="card" style="padding: 2.5rem; text-align: center; border-bottom: 4px solid var(--secondary-color); height: 100%; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <div style="font-size: 3rem; margin-bottom: 1.5rem;">💡</div>
                            <h2 style="color: var(--primary-color); margin-bottom: 1rem; font-size: 1.8rem;">TISC</h2>
                            <p style="color: var(--text-main); font-size: 1rem; line-height: 1.6;">
                                Technology and Innovation Support Centers offering access to local Patent database and high quality technological information.
                            </p>
                            <span class="btn btn-primary" style="margin-top: 1.5rem; display: inline-block;">Learn More</span>
                        </div>
                    </a>

                    <!-- Consultancy Card -->
                    <a href="{{ route('consultancy') }}" style="text-decoration: none; color: inherit; display: block;">
                        <div class="card" style="padding: 2.5rem; text-align: center; border-bottom: 4px solid var(--secondary-color); height: 100%; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <div style="font-size: 3rem; margin-bottom: 1.5rem;">🤝</div>
                            <h2 style="color: var(--primary-color); margin-bottom: 1rem; font-size: 1.8rem;">Consultancy & Advisory</h2>
                            <p style="color: var(--text-main); font-size: 1rem; line-height: 1.6;">
                                Expert guidance and advisory services tailored for industry partners and university researchers.
                            </p>
                            <span class="btn btn-primary" style="margin-top: 1.5rem; display: inline-block;">Learn More</span>
                        </div>
                    </a>

                    <!-- IP Services Card -->
                    <a href="{{ route('ip-services') }}" style="text-decoration: none; color: inherit; display: block;">
                        <div class="card" style="padding: 2.5rem; text-align: center; border-bottom: 4px solid var(--secondary-color); height: 100%; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <div style="font-size: 3rem; margin-bottom: 1.5rem;">⚖️</div>
                            <h2 style="color: var(--primary-color); margin-bottom: 1rem; font-size: 1.8rem;">IP Services</h2>
                            <p style="color: var(--text-main); font-size: 1rem; line-height: 1.6;">
                                Comprehensive details on IP filing, management, and commercialization support provided by BLII-TTO.
                            </p>
                            <span class="btn btn-primary" style="margin-top: 1.5rem; display: inline-block;">Learn More</span>
                        </div>
                    </a>

                    <!-- Patent Searches Card -->
                    <a href="{{ route('patent-searches') }}" style="text-decoration: none; color: inherit; display: block;">
                        <div class="card" style="padding: 2.5rem; text-align: center; border-bottom: 4px solid var(--secondary-color); height: 100%; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <div style="font-size: 3rem; margin-bottom: 1.5rem;">🔍</div>
                            <h2 style="color: var(--primary-color); margin-bottom: 1rem; font-size: 1.8rem;">Patent Searches</h2>
                            <p style="color: var(--text-main); font-size: 1rem; line-height: 1.6;">
                                Search through commonly used open-source patent databases and request access to commercial platforms.
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
