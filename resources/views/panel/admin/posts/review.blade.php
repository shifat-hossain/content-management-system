@extends('panel.master')

@section('title', 'post List')
@section('content')
    <h1 class="mt-4">Review Posts</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Review Posts</li>
    </ol>
    <div class="card mb-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-body">
            <h3>{{ $post->title }}</h3>
            <div>{!! $post->description !!}</div>

            <a href="{{ route('admin.posts.approval_status', ['post' => $post->slug, 'status' => 'approved']) }}" class="btn btn-success mt-2">Approve</a>
            <a href="{{ route('admin.posts.approval_status', ['post' => $post->slug, 'status' => 'rejected']) }}" class="btn btn-danger mt-2">Reject</a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <h5>Post Details</h5>
        </div>
        <div class="card-body">
            <p><strong>Author:</strong> {{ $post->user->name }}</p>
            <p><strong>Created At:</strong> {{ date('Y-m-d H:i', strtotime($post->created_at)) }}</p>
            <p><strong>Categories:</strong> {{ $post->categories->pluck('name')->implode(', ') }}</p>
            <p><strong>Tags:</strong> {{ $post->tags->pluck('name')->implode(', ') }}</p>
        </div>
    </div>
@endsection
