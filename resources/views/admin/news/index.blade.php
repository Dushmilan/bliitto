@extends('layouts.admin')

@section('title', 'News')

@section('content')
    <div class="admin-toolbar">
        <h1>News</h1>
        <a class="btn btn-primary" href="{{ route('admin.news.create') }}">New news item</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($newsItems as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->date->format('M d, Y') }}</td>
                    <td>
                        <span class="admin-badge {{ $item->published ? 'admin-badge-on' : 'admin-badge-off' }}">
                            {{ $item->published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td class="admin-actions">
                        <a href="{{ route('admin.news.edit', $item) }}">Edit</a>
                        <form method="POST" action="{{ route('admin.news.destroy', $item) }}" onsubmit="return confirm('Delete this news item?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-link-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="admin-muted">No news items yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $newsItems->links('admin.partials.pagination') }}
@endsection
