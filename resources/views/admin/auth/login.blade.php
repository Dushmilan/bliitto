@extends('layouts.admin')

@section('title', 'Sign in')

@section('content')
    <div class="admin-login">
        <h1>Sign in</h1>
        <p class="admin-muted">Administrator access only.</p>

        <form method="POST" action="{{ route('admin.login.store') }}">
            @csrf

            <div class="form-group @error('email') error @enderror">
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder=" ">
                <label for="email">Email address</label>
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group @error('password') error @enderror">
                <input type="password" id="password" name="password" required placeholder=" ">
                <label for="password">Password</label>
                @error('password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <label class="admin-remember">
                <input type="checkbox" name="remember" value="1"> Remember me
            </label>

            <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
    </div>
@endsection
