<div
    x-data="{expanded:'item-3'}"
>
    <div
        x-data="accordionItem('item-3')"
        class="overflow-hidden rounded-lg border border-slate-150 dark:border-navy-500"
    >
        <div
            @click="expanded = !expanded"
            class="flex items-center justify-between bg-slate-150 px-2 py-2 dark:bg-navy-500 sm:px-5"
        >
            <div
            class="flex items-center space-x-2 tracking-wide outline-none transition-all"
            >
                <div>
                    <p class="text-slate-600 line-clamp-1 dark:text-navy-100">
                    Lihat Surat Rekomendasi Penerbitan Penugasan Klinis [Jika tidak tampil, klik <a href="{{ route('applications.credential.prints.clinical-privilages', ['id' => $modelId]) }}" target="_blank" class="text-primary">disini</a>]
                    </p>
                </div>
            </div>
            <button
                class="btn -mr-1.5 size-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
            >
                <i
                    :class="expanded && '-rotate-180'"
                    class="fas fa-chevron-down text-sm transition-transform"
                ></i>
            </button>
        </div>
        <div x-collapse x-show="expanded">
            <div class="px-4 py-4 sm:px-5">
                <iframe src="{{ route('applications.credential.prints.clinical-privilages', ['id' => $modelId]) }}?q=authorized" width="100%" height="400" frameborder="0">
                    atau Buka PDF <a href="" targte="_blank">disini</a>
                </iframe>
            </div>
        </div>
    </div>
</div>
