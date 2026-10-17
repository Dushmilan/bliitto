<?php include 'includes/header.php'; ?>
<?php 
// Load dynamic data
include 'data/news.php'; 
include 'data/announcements.php';
?>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-overlay"></div>
        <img src="hero.jpg" alt="University of Peradeniya BLII-TTO" class="hero-bg lazyload">
        <div class="container hero-content">
            <h1 class="scroll-reveal">University of Peradeniya <span class="highlight">BLII-TTO</span></h1>
            <p class="scroll-reveal delay-1">Business Linkage, Innovation, Incubation and Technology Transfer Office.</p>
            <a href="about.php" class="btn btn-primary scroll-reveal delay-2">Discover Our Mission</a>
        </div>
    </section>

    <!-- Main Content Area -->
    <main>
        <!-- Intro Section -->
        <section id="about-intro" class="section bg-light">
            <div class="container grid-2-col align-center">
                <div class="about-text scroll-reveal">
                    <h2>Transforming <span class="highlight">Research</span> to Reality</h2>
                    <p>Being the pioneer university and the leading research university in Sri Lanka, the University of Peradeniya recognizes the need for encouraging the utilization of research findings for the development of the country by transforming results to practical applications and commercialization.</p>
                    <p>The core role of the Business Linkage, Innovation, Incubation and Technology Transfer Office is to assist the University in acquiring, managing and exploitation of its intellectual assets in ways that facilitate their transformation into benefits for the University, researches and in general the society.</p>
                    <ul class="feature-list">
                        <li><span class="icon">🔍</span> Receiving and reviewing Inventions</li>
                        <li><span class="icon">🛡️</span> Protecting and Licensing IP</li>
                        <li><span class="icon">🚀</span> Promoting Tech-based Entrepreneurship</li>
                    </ul>
                </div>
                <div class="about-image scroll-reveal delay-1">
                    <img src="about.jpg" alt="Research team at University of Peradeniya" loading="lazy" class="rounded-image shadow">
                </div>
            </div>
        </section>

        <!-- Dynamic News Section -->
        <!-- Dynamic News Section -->
        <section id="news" class="section" style="background-color: var(--primary-color); color: var(--white);">
            <div class="container">
                <div class="text-center scroll-reveal" style="margin-bottom: 3rem;">
                    <p style="font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; color: rgba(255,255,255,0.8); display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        Check Out What's Happening
                    </p>
                    <h2 style="font-size: 2.5rem; margin-top: 0;"><span style="color: var(--white);">Latest</span> <span class="highlight">News</span></h2>
                </div>
                
                <div class="news-grid mt-4">
                    <?php foreach ($news_items as $index => $item): ?>
                        <div class="news-card scroll-reveal <?php echo ($index > 0) ? 'delay-'.($index > 3 ? 3 : $index) : ''; ?>">
                            <div class="news-image-container">
                                <img src="<?php echo $item['image']; ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" class="news-img">
                            </div>
                            <div class="news-content">
                                <h3 class="news-title"><?php echo $item['title']; ?></h3>
                                <span class="news-date-inline"><?php echo $item['date']; ?></span>
                                <?php if(isset($item['description'])): ?>
                                    <p class="news-desc"><?php echo $item['description']; ?></p>
                                <?php else: ?>
                                    <p class="news-desc">The Business Linkage, Innovation, Incubation and Technology Transfer Office (BLII-TTO) proudly shares this latest update and ongoing commitment to excellence...</p>
                                <?php endif; ?>
                                <a href="<?php echo $item['link']; ?>" class="news-btn">Read More</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Dynamic Announcements Section -->
        <section id="announcements" class="section bg-light">
            <div class="container">
                <div class="text-center scroll-reveal" style="margin-bottom: 2rem;">
                    <h2 style="font-size: 2.5rem; color: var(--primary-color); margin-top: 0;">Announcements</h2>
                </div>
                
                <div class="announcement-list mt-4">
                    <?php foreach ($announcements as $index => $announcement): ?>
                        <div class="announcement-item scroll-reveal <?php echo ($index > 0) ? 'delay-'.($index > 3 ? 3 : $index) : ''; ?>">
                            <div class="announcement-badge">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                <?php echo $announcement['date']; ?>
                            </div>
                            <div class="announcement-text">
                                <p><?php echo $announcement['text']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        
        <!-- Call to Action -->
        <section class="cta-section">
            <div class="container text-center scroll-reveal">
                <h2>Got an <span style="color: #ffffff;">Innovative Idea?</span></h2>
                <p style="color: #000; font-weight: 500;">Submit your invention disclosure or connect with our technology transfer team today.</p>
                <a href="contact.php" class="btn btn-secondary">Submit & Track</a>
            </div>
        </section>
    </main>

<?php include 'includes/footer.php'; ?>
