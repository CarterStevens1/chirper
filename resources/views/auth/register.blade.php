<x-layout>
    <x-forms.form method="POST" action="/register" enctype="multipart/form-data" class="space-y-6">
        <x-forms.input
            class="file:bg-violet file:border-violet/10 text-white file:mr-4 file:rounded-xl file:px-4 file:py-2"
            accept="image/png, image/jpeg, image/webp" type="file" name="image" label="Image"
            value="{{ old('image') }}" />
        <x-forms.input name="name" label="Name *" />
        <x-forms.input name="email" label="Email *" type="email" />
        <x-forms.input name="password" label="Password *" type="password" />
        <x-forms.input name="password_confirmation" label="Confirm Password *" type="password" />

        <x-forms.divider />

        <x-forms.button>Create Account</x-forms.button>
    </x-forms.form>
</x-layout>
