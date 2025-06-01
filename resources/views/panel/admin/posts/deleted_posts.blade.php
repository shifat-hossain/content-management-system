@extends('panel.master')

@section('title', 'Delete Post List')
@section('content')

    <h1 class="mt-4">Delete Posts</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">Delete Post List</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Delete Post List
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
                        <th>Created At</th>
                        <th class="text-center">Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deleted_posts as $post)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ implode(', ', $post->categories->pluck('name')->toArray()) }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td class="text-center">
                                <label class="form-switch">
                                    <input class="form-check-input" role="switch" onchange="update_status(this)" value="{{ $post->id }}" type="checkbox"
                                        @checked($post->is_published == 1)>
                                </label>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.posts.restore', $post->slug) }}" class="btn btn-primary">
                                    Restore
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $deleted_posts->links() }}
        </div>
    </div>
@endsection

@section('extra_script')
    <script>
        function update_status(checkbox) {
            let post_id = checkbox.value;
            let isChecked = checkbox.checked;

            $.ajax({
                url: "{{ route('user.posts.change_status') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: post_id,
                    status: isChecked ? 1 : 0
                },
                success: function(response) {
                    alert('Post status updated successfully!');
                },
                error: function(xhr) {
                    console.error(xhr);
                }
            });
        }
    </script>
@endsection
