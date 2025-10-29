@props([
    'name',
    'label',
])

<div class="inline-flex items-center gap-x-2">
    <span class="bg-violet inline-block h-2 w-2"></span>
    <label class="font-bold" for="{{ $name }}">{{ $label }}</label>
</div>
