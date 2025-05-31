@props([
    'name', 
    'type' => 'text',
    'value' => '',
    ])

<input type="{{ $type }}" name="{{ $name }}" class="form-control mb-2" value="{{ $value }}" required>
