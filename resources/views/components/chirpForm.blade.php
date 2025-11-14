<x-forms.form id="chirp" method="POST" action="/chirp-create" enctype="multipart/form-data">
    <x-forms.textArea required name="message" label="" placeholder="Today I rode a bike..." />
    <div class="pt-3 mx-auto flex max-w-2xl justify-between items-center flex-wrap gap-4">
        <x-forms.input
            class="file:bg-violet file:border-violet/10 text-white file:mr-4 file:rounded-xl file:px-2 file:py-1 p-2!"
            accept="image/png, image/jpeg, image/webp" type="file" name="image" label="" />
        <button form="chirp"
            class="inline-block dark:bg-[#eeeeec] dark:border-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white dark:hover:border-white hover:bg-black hover:border-black px-5 py-2 bg-[#1b1b18] rounded-sm border border-black text-white text-sm leading-normal">Post</button>
    </div>
</x-forms.form>
