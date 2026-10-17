<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLII-TTO | University of Peradeniya</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
<header class="navbar" id="navbar">
    <div class="container nav-container">
        <a href="index.php" class="logo" style="display:flex;align-items:center;gap:0.75rem;text-decoration:none;">
            <img src="uop-logo-transparent.png" alt="UoP Logo" style="height:45px;width:auto;">
            <span class="logo-text"><span class="logo-title-main">BLII-TTO</span> <span style="font-size:0.8rem;font-weight:500;color:var(--text-light);">UoP</span></span>
        </a>
        <button class="menu-toggle" id="mobile-menu" aria-label="Toggle menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
        <nav class="nav-menu" id="nav-menu">
            <ul>
                <li><a href="index.php" class="nav-link">Home</a></li>
                <li class="dropdown">
                    <a href="about.php" class="nav-link">About</a>
                    <ul class="dropdown-menu">
                        <li><a href="about.php#vision">Vision &amp; Mission</a></li>
                        <li><a href="about.php#staff">Staff</a></li>
                        <li><a href="about.php#ip-committee">IP Advisory Committee</a></li>
                        <li><a href="about.php#coordinating">Coordinating Committee</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="services.php" class="nav-link">Services</a>
                    <ul class="dropdown-menu">
                        <li><a href="tisc.php">TISC</a></li>
                        <li><a href="consultancy.php">Consultancy &amp; Advisory</a></li>
                        <li><a href="ip-services.php">IP Services</a></li>
                        <li><a href="patent-searches.php">Patent Searches</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="industry.php" class="nav-link">Industry</a>
                    <ul class="dropdown-menu">
                        <li><a href="patented-technologies.php">Patented Technologies</a></li>
                        <li><a href="technology-know-how.php">Technology Know-How</a></li>
                        <li><a href="researchers.php">Researchers</a></li>
                    </ul>
                </li>
                <li><a href="centers.php" class="nav-link">Centers</a></li>
                <li><a href="contact.php" class="nav-link">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>
