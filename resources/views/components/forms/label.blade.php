@props([
    'name',
    'label',
])

<div class="inline-flex items-center gap-x-2">
    <label class="font-bold text-white" for="{{ $name }}">{{ $label }}</label>
</div>
