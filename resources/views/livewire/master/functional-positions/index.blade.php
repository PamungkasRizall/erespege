<main class="main-content w-full px-[var(--margin-x)] pb-8">
    {{-- Header Section --}}
    <div class="flex items-center justify-between space-x-6 py-5 lg:py-6">
        <x-page-header :title="$meta_title" />

        <x-forms.button-add-new @click="$dispatch('open-modal')" />
    </div>

    {{-- Main Content --}}
    <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
        <livewire:tables.functionalPositions-table />
    </div>

    {{-- Form Modal --}}
    <x-partials.modal class="max-w-xl" :head-name="($model_id ? 'Edit' : 'Tambah') . ' ' . Str::singular($meta_title)">
        @include('livewire.master.functional-positions.form')
    </x-partials.modal>

    {{-- Utility Modals --}}
    <x-partials.confirm type="delete" />

</main>
