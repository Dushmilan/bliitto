@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1>Dashboard</h1>

    <p class="admin-muted">Signed in as {{ auth()->user()->email }}.</p>

    <div class="admin-cards">
        <a class="admin-card" href="{{ route('admin.news.index') }}">
            <span class="admin-card-value">{{ $publishedNews }}</span>
            <span class="admin-card-label">Published news</span>
        </a>
        <a class="admin-card" href="{{ route('admin.announcements.index') }}">
            <span class="admin-card-value">{{ $activeAnnouncements }}</span>
            <span class="admin-card-label">Active announcements</span>
        </a>
        <a class="admin-card" href="{{ route('admin.messages.index') }}">
            <span class="admin-card-value">{{ $unreadMessages }}</span>
            <span class="admin-card-label">Unread messages</span>
        </a>
    </div>
@endsection
