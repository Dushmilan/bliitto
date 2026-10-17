@extends('layouts.admin')

@section('title', 'Edit announcement')

@section('content')
    <h1>Edit announcement</h1>

    <form method="POST" action="{{ route('admin.announcements.update', $announcement) }}" class="admin-form">
        @method('PUT')
        @include('admin.announcements._form')
    </form>
@endsection
