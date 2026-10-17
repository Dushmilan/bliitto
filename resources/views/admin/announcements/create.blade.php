@extends('layouts.admin')

@section('title', 'New announcement')

@section('content')
    <h1>New announcement</h1>

    <form method="POST" action="{{ route('admin.announcements.store') }}" class="admin-form">
        @include('admin.announcements._form')
    </form>
@endsection
