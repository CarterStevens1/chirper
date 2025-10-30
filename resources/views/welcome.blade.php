<x-layout>
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Dashboard
                    </a>

                    <form method="POST" action="/logout">
                        @csrf
                        @method('POST')
                        <button
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                            id="logOut" href="{{ Route('logout') }}">Log Out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>
    <div
        class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <main class="justify-center flex w-full flex-col-reverse lg:max-w-3xl lg:flex-row">
            <section class="w-full">
                <div
                    class="p-4 mb-5 text-[13px] leading-5 flex-1 bg-white dark:bg-lightGrey dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg">
                    <x-forms.form id="chirp" method="POST" action="/chirp-create" enctype="multipart/form-data">
                        <x-forms.textArea required name="message" label="" placeholder="Today I rode a bike..." />
                        <div class="pt-3 mx-auto flex max-w-2xl justify-between items-center flex-wrap gap-4">
                            <x-forms.input
                                class="file:bg-violet file:border-violet/10 text-white file:mr-4 file:rounded-xl file:px-2 file:py-1 p-2!"
                                accept="image/png, image/jpeg, image/webp" type="file" name="image"
                                label="" />
                            <button form="chirp"
                                class="inline-block dark:bg-[#eeeeec] dark:border-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white dark:hover:border-white hover:bg-black hover:border-black px-5 py-2 bg-[#1b1b18] rounded-sm border border-black text-white text-sm leading-normal">Post</button>
                        </div>
                    </x-forms.form>

                </div>
                @foreach ($chirps as $chirp)
                    @php
                        $end = \Carbon\Carbon::parse($chirp->created_at);
                        $start = \Carbon\Carbon::now();
                        $total = round($end->diffInMinutes($start), 0);
                        if ($total > 1440) {
                            $total = round($total / 1440, 0) . 'd';
                        } elseif ($total > 60) {
                            $total = round($total / 60, 0) . 'h';
                        } else {
                            $total = $total . 'm';
                        }
                    @endphp
                    <div
                        class="mb-5 text-[13px] leading-5 flex-1 bg-white dark:bg-lightGrey dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg">
                        <div class="p-8 lg:p-10 lg:pb-8">
                            @foreach (preg_split('/\n+/', $chirp->message) as $message)
                                @if (trim($message) !== '')
                                    <p class="text-white text-lg not-last:mb-3">{{ $message }}</p>
                                @endif
                            @endforeach
                            @if ($chirp->image !== null)
                                <img class="aspect-square lg:aspect-video max-h-100 object-cover rounded-lg mt-6"
                                    src="{{ asset($chirp->image) }}" alt="User profile picture" />
                            @endif
                        </div>
                        <div class="p-8 lg:px-10 lg:pb-10 flex justify-between items-center">
                            <div class="flex gap-4 items-center">
                                @if ($chirp->user->image !== null)
                                    <img width="40" height="40" class="size-10 rounded-full"
                                        src="{{ asset($chirp->user->image) }}" alt="User profile picture" />
                                @endif
                                <span>{{ $chirp->user->name }}</span>
                            </div>
                            <span class="text-sm text-white">{{ $total }}</span>
                        </div>
                    </div>
                @endforeach

                @if ($chirps->count() == 0)
                    <div
                        class="mb-5 text-[13px] leading-5 flex-1 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg">
                        <div class="p-12">
                            <p class="text-white">No chirps yet</p>
                        </div>
                    </div>
                @endif
            </section>
        </main>
    </div>

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</x-layout>
