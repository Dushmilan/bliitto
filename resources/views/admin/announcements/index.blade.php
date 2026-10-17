@extends('layouts.admin')

@section('title', 'Announcements')

@section('content')
    <div class="admin-toolbar">
        <h1>Announcements</h1>
        <a class="btn btn-primary" href="{{ route('admin.announcements.create') }}">New announcement</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Text</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($announcements as $announcement)
                <tr>
                    <td>{{ $announcement->date->format('M d, Y') }}</td>
                    <td>{{ Str::limit($announcement->text, 90) }}</td>
                    <td>
                        <span class="admin-badge {{ $announcement->active ? 'admin-badge-on' : 'admin-badge-off' }}">
                            {{ $announcement->active ? 'Active' : 'Hidden' }}
                        </span>
                    </td>
                    <td class="admin-actions">
                        <a href="{{ route('admin.announcements.edit', $announcement) }}">Edit</a>
                        <form method="POST" action="{{ route('admin.announcements.destroy', $announcement) }}" onsubmit="return confirm('Delete this announcement?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-link-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="admin-muted">No announcements yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $announcements->links('admin.partials.pagination') }}
@endsection
