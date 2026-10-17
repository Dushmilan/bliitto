@extends('layouts.app')

@section('content')

    <main class="page-transition" style="padding: 120px 0 60px 0; min-height: 80vh;">
        <!-- Header Section -->
        <section class="section text-center">
            <div class="container">
                <h1 class="scroll-reveal" style="font-size: 3rem; color: var(--primary-color);">University <span class="highlight">Centers</span></h1>
                <p class="scroll-reveal delay-1" style="font-size: 1.1rem; max-width: 700px; margin: 1rem auto; color: var(--text-light);">
                    Discover the specialized centers across the University of Peradeniya collaborating with BLII-TTO to foster innovation and industry linkage.
                </p>
            </div>
        </section>

        <!-- Centers Grid -->
        <section class="section bg-light">
            <div class="container">
                <div class="grid-3-col scroll-reveal delay-1" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                    
                    <!-- Agri-Business -->
                    <a href="http://agri.pdn.ac.lk/abc/" target="_blank" class="center-card">
                        <div class="center-icon">🌾</div>
                        <div class="center-content">
                            <h3>Agri-Business Centre</h3>
                            <span class="btn-text">Visit Website &rarr;</span>
                        </div>
                    </a>

                    <!-- Career Guidance -->
                    <a href="http://www.pdn.ac.lk/cgu/" target="_blank" class="center-card">
                        <div class="center-icon">🧭</div>
                        <div class="center-content">
                            <h3>Career Guidance and Counselling Unit</h3>
                            <span class="btn-text">Visit Website &rarr;</span>
                        </div>
                    </a>

                    <!-- Science Industry -->
                    <a href="#" class="center-card">
                        <div class="center-icon">🔬</div>
                        <div class="center-content">
                            <h3>Science Industry Interaction Cell</h3>
                            <span class="btn-text" style="color: #6c757d;">More Info Coming Soon</span>
                        </div>
                    </a>

                    <!-- Biotech -->
                    <a href="http://agri.pdn.ac.lk/agbc/" target="_blank" class="center-card">
                        <div class="center-icon">🧬</div>
                        <div class="center-content">
                            <h3>Agriculture Biotechnology Centre</h3>
                            <span class="btn-text">Visit Website &rarr;</span>
                        </div>
                    </a>

                    <!-- Engineering -->
                    <a href="http://eng.pdn.ac.lk/etic/index.php" target="_blank" class="center-card">
                        <div class="center-icon">⚙️</div>
                        <div class="center-content">
                            <h3>Engineering Technology Innovation Center</h3>
                            <span class="btn-text">Visit Website &rarr;</span>
                        </div>
                    </a>

                </div>
            </div>
        </section>
    </main>

@endsection
