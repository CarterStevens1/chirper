@props([
    'label',
    'name',
])

@php
    $defaults = [
        'type' => 'text',
        'id' => $name,
        'name' => $name,
        'class' => 'w-full rounded-xl border border-white/10 bg-white/10 px-5 py-4',
        'value' => old($name),
    ];
@endphp

<x-forms.field :$label :$name>
    <textarea {{ $attributes($defaults) }}>{{ $slot }}</textarea>
</x-forms.field>
