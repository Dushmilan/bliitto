@extends('layouts.admin')

@section('title', 'Message')

@section('content')
    <h1>Message from {{ $message->name }}</h1>

    <p class="admin-muted">
        <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
        &middot; {{ $message->created_at->format('M d, Y H:i') }}
    </p>

    <div class="admin-message-body">{!! nl2br(e($message->message)) !!}</div>

    <div class="admin-form-actions">
        <a href="{{ route('admin.messages.index') }}">Back to inbox</a>
        <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Delete this message?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="admin-link-danger">Delete</button>
        </form>
    </div>
@endsection
