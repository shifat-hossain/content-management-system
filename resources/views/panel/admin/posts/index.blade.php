@extends('panel.master')

@section('title', 'post List')
@section('content')

    <h1 class="mt-4">posts</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">post List</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            post List
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary float-end">
                Create post
            </a>
        </div>
        <div class="card-body">
            <table id="myTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Categories</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Approval</th>
                        <th>Approved At</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ implode(', ', $post->categories->pluck('name')->toArray()) }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>
                                @if ($post->approved_status == 'approved')
                                    <span class="badge bg-success">
                                        {{ $post->approved_status }}
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        {{ $post->approved_status }}
                                    </span>
                                @endif
                            </td>
                            <td>{{ $post->approved_at }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.posts.edit', $post->slug) }}"
                                    class="btn btn-success">
                                    Edit
                                </a>
                                <a href="{{ route('admin.post_review', $post->slug) }}" class="btn btn-primary">Review</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $posts->links() }}
        </div>
    </div>
@endsection
