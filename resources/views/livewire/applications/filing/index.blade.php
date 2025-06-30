<div class="card px-4 pb-4 my-4 sm:px-5 col-span-12" x-data="{expandedFiling:true}">
    <div class="my-3 flex h-8 items-center justify-between" @click="expandedFiling = !expandedFiling">
        <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
            {{ $meta_title }}
        </h2>
        <div
            :class="expandedFiling && '-rotate-180'"
            class="text-sm font-normal leading-none text-primary transition-transform duration-300 dark:text-navy-300"
        >
            <i class="fas fa-chevron-down"></i>
        </div>
    </div>
    <div x-collapse x-show="expandedFiling">

        @include('livewire.applications.filing.table', ['form' => true])
        {{-- <div class="flex items-center">
            <x-forms.button-add-new @click="$dispatch('open-modal')" />
        </div>
        <div class="is-scrollbar min-w-full overflow-x-auto">
            <livewire:tables.manual-filings-table />
        </div> --}}
    </div>

    <x-partials.modal class="max-w-xl" :head-name=$name>
        @include('livewire.applications.filing.form')
    </x-partials.modal>

    {{-- Utility Modals --}}
    <x-partials.confirm type="delete" />
</div>
