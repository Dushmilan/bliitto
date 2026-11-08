@extends('layouts.admin')

@section('title', 'Sign in')
@section('main_class', 'admin-main admin-login-main')

@section('content')
    <div class="admin-login">
        <section class="login-brand" aria-label="About BLII-TTO">
            <div class="login-brand-inner">
                <div class="login-brand-top">
                    <img src="{{ asset('uop-logo-transparent.png') }}" alt="" class="login-crest">
                    <span class="login-brand-kicker">University of Peradeniya</span>
                </div>

                <div class="login-brand-copy">
                    <span class="login-brand-rule" aria-hidden="true"></span>
                    <p class="login-brand-office">Business Linkage, Innovation, Incubation &amp; Technology Transfer Office</p>
                    <h2>Supporting research from discovery to impact.</h2>
                    <p>Patent protection, industry partnerships, consultancy and incubation support for the University of Peradeniya.</p>
                </div>

                <p class="login-brand-foot">
                    BLII-TTO &middot; <a href="mailto:{{ config('bliitto.contact_recipient') }}">{{ config('bliitto.contact_recipient') }}</a>
                </p>
            </div>
        </section>

        <section class="login-panel" aria-labelledby="login-heading">
            <div class="login-card">
                <div class="login-card-head">
                    <p class="login-eyebrow">Staff access</p>
                    <h1 id="login-heading">Sign in</h1>
                    <p class="admin-muted">Administrator access only. Use the account issued by the BLII-TTO office.</p>
                </div>

                <form method="POST" action="{{ route('admin.login.store') }}" class="login-form">
                    @csrf

                    <div class="login-field @error('email') has-error @enderror">
                        <label for="email">Email address</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            autocomplete="username"
                            inputmode="email"
                            required
                            autofocus
                            @error('email') aria-invalid="true" aria-describedby="email-error" @enderror
                        >
                        @error('email')
                            <p class="login-error" id="email-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="login-field @error('password') has-error @enderror">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            autocomplete="current-password"
                            required
                            @error('password') aria-invalid="true" aria-describedby="password-error" @enderror
                        >
                        @error('password')
                            <p class="login-error" id="password-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <label class="admin-remember login-remember">
                        <input type="checkbox" name="remember" value="1" @checked(old('remember'))>
                        <span>Keep me signed in</span>
                    </label>

                    <button type="submit" class="btn btn-primary login-submit">Sign in</button>
                </form>

                <p class="login-back"><a href="{{ route('home') }}">Back to the public site</a></p>
            </div>
        </section>
    </div>
@endsection
