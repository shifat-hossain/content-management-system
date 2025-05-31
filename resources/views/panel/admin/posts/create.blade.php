@extends('panel.master')

@section('title', 'Create Post')
@section('content')

    <h1 class="mt-4">Posts</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{ route('user.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('user.posts.index') }}">Post</a>
        </li>
        <li class="breadcrumb-item active">Create Post</li>
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
            <form action="{{ route('user.posts.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-7">
                        <x-forms.field class="col-12">
                            <x-forms.label name="title" class="form-label" />
                            <x-forms.input name='title' value="{{ old('title') }}" />
                        </x-forms.field>
                        <x-forms.field class="col-12">
                            <x-forms.label name="tags" class="form-label" />
                            <x-forms.input name='tags' value="" />
                            <small>Separate with commas</small>
                        </x-forms.field>
                    </div>
                    <div class="col-lg-5">
                        <x-forms.label name="category" class="form-label" />
                        <div class="category-tree">
                            @include('panel.partials.category_tree', [
                                'categories' => $categories,
                                'selected' => old('categories', []),
                            ])
                        </div>
                    </div>
                    <x-forms.field class="col-12">
                        <x-forms.label name="description" class="form-label" />
                        <x-forms.textarea name='description' id="summernote" value="{{ old('description') }}" />
                    </x-forms.field>
                </div>

                <button type="submit" class="btn btn-primary">{{ trans('Submit') }}</button>
            </form>
        </div>

    </div>
@endsection

@section('extra_script')
    
@endsection
