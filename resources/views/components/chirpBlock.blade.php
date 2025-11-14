@props(['chirps'])

@foreach ($chirps as $chirp)
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
                    src="{{ Storage::url($chirp->image) }}" alt="User profile picture" />
            @endif
        </div>
        <div class="p-8 lg:px-10 lg:pb-10 flex justify-between items-center">
            <div class="flex gap-4 items-center">
                @if ($chirp->user->logo !== null)
                    <img width="40" height="40" class="size-10 rounded-full"
                        src="{{ Storage::url($chirp->user->logo) }}" alt="User profile picture" />
                @endif
                <span>{{ $chirp->user->name }}</span>
            </div>
            <span class="text-sm text-white">{{ $chirp->time_diff }}</span>
        </div>
    </div>
@endforeach

@if ($chirps->count() == 0)
    <div
        class="mb-5 text-[13px] leading-5 flex-1 bg-white dark:bg-lightGrey dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg">
        <div class="p-12">
            <p class="text-white">No chirps yet</p>
        </div>
    </div>
@endif
