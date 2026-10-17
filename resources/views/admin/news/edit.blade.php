@extends('layouts.admin')

@section('title', 'Edit news item')

@section('content')
    <h1>Edit news item</h1>

    <form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data" class="admin-form">
        @method('PUT')
        @include('admin.news._form')
    </form>
@endsection
