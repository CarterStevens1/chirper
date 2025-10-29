<x-layout>
    <section class="mx-auto flex w-full max-w-2xl flex-col items-center justify-center space-y-8 pt-16">
        <h1 class="text-3xl font-semibold text-white">Log in to dashboard</h1>
        <x-forms.form method="POST" action="/adminPanel" enctype="multipart/form-data">
            <x-forms.input name="email" label="Email" type="text" />
            <x-forms.input name="password" label="Password" type="password" />

            <x-forms.button>Log in</x-forms.button>
        </x-forms.form>
    </section>
</x-layout>
