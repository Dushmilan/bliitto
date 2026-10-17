@extends('layouts.admin')

@section('title', 'Contact messages')

@section('content')
    <h1>Contact messages</h1>

    <table class="admin-table">
        <thead>
            <tr>
                <th>From</th>
                <th>Received</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($messages as $message)
                <tr class="{{ $message->isRead() ? '' : 'admin-row-unread' }}">
                    <td>
                        {{ $message->name }}
                        <span class="admin-muted">{{ $message->email }}</span>
                    </td>
                    <td>{{ $message->created_at->format('M d, Y H:i') }}</td>
                    <td>
                        <span class="admin-badge {{ $message->isRead() ? 'admin-badge-off' : 'admin-badge-on' }}">
                            {{ $message->isRead() ? 'Read' : 'Unread' }}
                        </span>
                    </td>
                    <td class="admin-actions">
                        <a href="{{ route('admin.messages.show', $message) }}">Open</a>
                        <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Delete this message?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-link-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="admin-muted">No messages yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $messages->links('admin.partials.pagination') }}
@endsection
