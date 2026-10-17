<header class="navbar" id="navbar">
    <div class="container nav-container">
        <a href="{{ route('home') }}" class="logo" style="display:flex;align-items:center;gap:0.75rem;text-decoration:none;">
            <img src="{{ asset('uop-logo-transparent.png') }}" alt="UoP Logo" style="height:45px;width:auto;">
            <span class="logo-text"><span class="logo-title-main">BLII-TTO</span> <span style="font-size:0.8rem;font-weight:500;color:var(--text-light);">UoP</span></span>
        </a>
        <button class="menu-toggle" id="mobile-menu" aria-label="Toggle menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
        <nav class="nav-menu" id="nav-menu">
            <ul>
                <li><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                <li class="dropdown">
                    <a href="{{ route('about') }}" class="nav-link">About</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('about') }}#vision">Vision &amp; Mission</a></li>
                        <li><a href="{{ route('about') }}#staff">Staff</a></li>
                        <li><a href="{{ route('about') }}#ip-committee">IP Advisory Committee</a></li>
                        <li><a href="{{ route('about') }}#coordinating">Coordinating Committee</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="{{ route('services') }}" class="nav-link">Services</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('tisc') }}">TISC</a></li>
                        <li><a href="{{ route('consultancy') }}">Consultancy &amp; Advisory</a></li>
                        <li><a href="{{ route('ip-services') }}">IP Services</a></li>
                        <li><a href="{{ route('patent-searches') }}">Patent Searches</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="{{ route('industry') }}" class="nav-link">Industry</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('patented-technologies') }}">Patented Technologies</a></li>
                        <li><a href="{{ route('technology-know-how') }}">Technology Know-How</a></li>
                        <li><a href="{{ route('researchers') }}">Researchers</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('centers') }}" class="nav-link">Centers</a></li>
                <li><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>
