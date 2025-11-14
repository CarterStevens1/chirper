<x-layout>
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        <x-navigation.navigation />
    </header>
    <div
        class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <main class="justify-center flex w-full flex-col-reverse lg:max-w-3xl lg:flex-row">
            <section class="w-full">
                <div
                    class="p-4 mb-5 text-[13px] leading-5 flex-1 bg-white dark:bg-lightGrey dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg">
                    <x-chirpForm />
                </div>
                <x-chirpBlock :chirps="$chirps" />
            </section>
        </main>
    </div>

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</x-layout>
