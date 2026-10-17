@extends('layouts.app')

@section('content')

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
                    <form id="contact-form" class="modern-form" method="POST" action="{{ url('/contact') }}">
                        @csrf

                        {{-- Honeypot: hidden from people, attractive to bots. --}}
                        <div style="position:absolute;left:-9999px;" aria-hidden="true">
                            <label for="website">Website</label>
                            <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="form-group @error('name') error @enderror">
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder=" ">
                            <label for="name">Full Name</label>
                            <span class="error-msg">@error('name') {{ $message }} @else Please enter your name. @enderror</span>
                        </div>

                        <div class="form-group @error('email') error @enderror">
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder=" ">
                            <label for="email">Email Address</label>
                            <span class="error-msg">@error('email') {{ $message }} @else Please enter a valid email. @enderror</span>
                        </div>

                        <div class="form-group @error('message') error @enderror">
                            <textarea id="message" name="message" rows="5" required placeholder=" ">{{ old('message') }}</textarea>
                            <label for="message">Your Message</label>
                            <span class="error-msg">@error('message') {{ $message }} @else Please enter a message. @enderror</span>
                        </div>

                        <button type="submit" class="btn btn-primary btn-submit" id="submit-btn">
                            <span class="btn-text">Send Message</span>
                            <span class="spinner"></span>
                        </button>

                        <div id="form-success" class="form-success @if (session('status')) show @endif">
                            {{ session('status', 'Thank you! Your message has been sent successfully.') }}
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

@endsection
