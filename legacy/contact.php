<?php include 'includes/header.php'; ?>

    <main style="padding: 120px 0 60px 0; min-height: 80vh;">
        <section class="section">
            <div class="container grid-2-col">
                <div class="contact-info scroll-reveal">
                    <h2>Get in <span class="highlight">Touch</span></h2>
                    <p>Have an innovative idea? Need help with technology transfer? We are here to assist you.</p>
                    
                    <div class="mt-4">
                        <h4>📍 Address</h4>
                        <p>Senate Building, University of Peradeniya, Sri Lanka</p>
                        
                        <h4 class="mt-4">✉️ Email</h4>
                        <p>bliitto@pdn.ac.lk</p>
                    </div>
                </div>
                
                <div class="contact-form-container scroll-reveal delay-1">
                    <form id="contact-form" class="modern-form">
                        <div class="form-group">
                            <input type="text" id="name" name="name" required placeholder=" ">
                            <label for="name">Full Name</label>
                            <span class="error-msg">Please enter your name.</span>
                        </div>
                        
                        <div class="form-group">
                            <input type="email" id="email" name="email" required placeholder=" ">
                            <label for="email">Email Address</label>
                            <span class="error-msg">Please enter a valid email.</span>
                        </div>
                        
                        <div class="form-group">
                            <textarea id="message" name="message" rows="5" required placeholder=" "></textarea>
                            <label for="message">Your Message</label>
                            <span class="error-msg">Please enter a message.</span>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-submit" id="submit-btn">
                            <span class="btn-text">Send Message</span>
                            <span class="spinner"></span>
                        </button>
                        
                        <div id="form-success" class="form-success">
                            Thank you! Your message has been sent successfully.
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
<?php include 'includes/footer.php'; ?>
