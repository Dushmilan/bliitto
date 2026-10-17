@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1>Dashboard</h1>

    <p class="admin-muted">Signed in as {{ auth()->user()->email }}.</p>

    <p>Content management for news, announcements and contact messages arrives in the next step.</p>
@endsection
