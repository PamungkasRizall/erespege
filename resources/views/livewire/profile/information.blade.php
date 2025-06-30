<div class="alert flex overflow-hidden rounded-lg bg-{{ $color }}/10 text-{{ $color }} dark:bg-{{ $color }}/15 mb-2">
    <div class="flex flex-1 items-center space-x-3 space-x-reverse p-4">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                />
        </svg>
        <div class="flex-1 font-medium pl-2">{{ $msg }}</div>
    </div>
    <div class="w-1.5 bg-{{ $color }}"></div>
</div>
