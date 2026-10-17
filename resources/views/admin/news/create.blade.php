@extends('layouts.admin')

@section('title', 'New news item')

@section('content')
    <h1>New news item</h1>

    <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data" class="admin-form">
        @include('admin.news._form')
    </form>
@endsection
