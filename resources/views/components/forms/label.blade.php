@props(['name'])
<label for="{{ $name }}" {{ $attributes->merge(['class']) }}>{{ ucwords($name) }}</label>