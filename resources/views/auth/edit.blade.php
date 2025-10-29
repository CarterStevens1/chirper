<x-layout>
    <div class="w-full lg:flex lg:flex-col lg:gap-4">
        <main class="py-12">
            <div>
                <x-forms.form id="update" method="POST" action="/edit" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium text-white">Current Profile picutre</label>
                        <div class="rounded-lg border-2 border-dashed border-gray-300 p-4">
                            @if (auth()->user()->image && asset('images/' . auth()->user()->image))
                                <div class="relative">
                                    <img src="{{ asset('images/' . auth()->user()->image) }}" alt="Current image"
                                        class="mx-auto h-48 max-w-full rounded object-contain" id="currentImage" />
                                </div>
                                <p class="mt-2 text-center text-sm text-gray-500">
                                    {{ basename(auth()->user()->image_path) }}
                                </p>
                            @else
                                <div class="text-center text-gray-500">
                                    <p>No image uploaded</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <x-forms.input
                        class="file:bg-violet file:border-violet/10 text-white file:mr-4 file:rounded-xl file:px-4 file:py-2"
                        accept="image/png, image/jpeg, image/webp" type="file" name="image" label="Profile picture"
                        value="{{ old('image') }}" />
                    <x-forms.input name="name" label="Name" type="text" value="{{ auth()->user()->name }}" />
                    <x-forms.input name="current_password" label="Password" type="password" />
                    <x-forms.input name="password" label="New password" type="password" />
                    <x-forms.input name="password_confirmation" label="Confirm new password" type="password" />

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-success">
                            {{ session('error') }}
                        </div>
                    @endif
                </x-forms.form>
                <x-forms.divider />
                <div class="mx-auto flex max-w-2xl justify-between space-y-6">
                    <button variant="save" form="update">Save</button>
                    <form id="delete" method="POST" action="/destroy">
                        @csrf
                        @method('POST')
                        <button onclick="return confirm('Are you sure you want to delete your account?')" form="delete"
                            class="mx-0 flex cursor-pointer gap-2 rounded bg-red-500 px-6 py-2 font-bold text-white">
                            Delete User
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-layout>
