@props([
    'name',
    'options' => [],
    'selected' => null,
    'label' => null,
    'required' => false,
    'placeholder' => 'Select an option',
    'id' => null,
    'class' => '',
])


<select name="{{ $name }}" id="{{ $id ?? $name }}" {{ $required ? 'required' : '' }}
    {{ $attributes->merge(['class' => 'form-select ' . $class]) }}>
    <option value="">{{ $placeholder }}</option>
    @foreach ($options as $key => $value)
        <option value="{{ $key }}" @if (old($name, $selected) == $key) selected @endif>
            {{ $value }}
        </option>
    @endforeach
</select>
