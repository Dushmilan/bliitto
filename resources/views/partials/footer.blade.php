<footer class="footer">
    <div class="container footer-grid-4">
        <div>
            <div class="footer-logo">
                <img src="{{ asset('uop-logo-transparent.png') }}" alt="UoP" class="footer-logo-img">
                <div class="footer-logo-text">
                    <span class="logo-text-main">BLII-TTO</span>
                    <span class="logo-text-sub">UNIVERSITY OF PERADENIYA</span>
                </div>
            </div>
            <p class="footer-desc">Business Linkage, Innovation, Incubation and Technology Transfer Office. Transforming research to reality.</p>
            <div class="social-icons" style="margin-top:1rem;">
                <a href="#" class="social-icon" aria-label="Facebook">f</a>
                <a href="#" class="social-icon" aria-label="LinkedIn">in</a>
                <a href="#" class="social-icon" aria-label="X">x</a>
            </div>
        </div>
        <div>
            <h3>Quick Links</h3>
            <ul class="footer-links">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="{{ route('services') }}">Services</a></li>
                <li><a href="{{ route('industry') }}">Industry</a></li>
                <li><a href="{{ route('centers') }}">Centers</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>
        <div>
            <h3>Services</h3>
            <ul class="footer-links">
                <li><a href="{{ route('tisc') }}">TISC</a></li>
                <li><a href="{{ route('consultancy') }}">Consultancy</a></li>
                <li><a href="{{ route('ip-services') }}">IP Services</a></li>
                <li><a href="{{ route('patent-searches') }}">Patent Searches</a></li>
                <li><a href="{{ route('downloads') }}">Downloads</a></li>
                <li><a href="{{ route('submission') }}">Submit Invention</a></li>
            </ul>
        </div>
        <div>
            <h3>Contact</h3>
            <ul class="contact-list">
                <li><span class="icon">📍</span><div class="contact-text"><strong>Address</strong><p>Senate Building, University of Peradeniya, Sri Lanka</p></div></li>
                <li><span class="icon">✉️</span><div class="contact-text"><strong>Email</strong><p>bliitto@pdn.ac.lk</p></div></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container footer-bottom-flex">
            <p>&copy; {{ date('Y') }} BLII-TTO, University of Peradeniya. All rights reserved.</p>
            <p>TISC / WIPO Collaboration</p>
        </div>
    </div>
</footer>
