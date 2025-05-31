@props([
    'name',
    'id',
    'value' => '',
    ])

<textarea name="{{ $name }}" id="{{ $id }}" class="form-control mb-2" required>{{ $value }}</textarea>
