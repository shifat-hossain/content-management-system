@extends('panel.master')

@section('title', 'Edit Category')
@section('content')

    <h1 class="mt-4">Categorys</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.categories.index') }}">Category</a>
        </li>
        <li class="breadcrumb-item active">Edit Category</li>
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
            <form action="{{ route('admin.categories.update', $category->slug) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <x-forms.field class="col-6">
                        <x-forms.label name="name" class="form-label" />
                        <x-forms.input name='name' value="{{ $category->name }}" />
                    </x-forms.field>
                    <x-forms.field class="col-6">
                        <x-forms.label name="parent category" class="form-label" />
                        <x-forms.select name="parent_id" :options="$categories->pluck('name', 'id')->toArray()" :selected="$category->parent_id" />
                    </x-forms.field>
                </div>

                <button type="submit" class="btn btn-primary">{{ trans('Update') }}</button>
            </form>
        </div>

    </div>
@endsection

@section('extra_script')

@endsection
