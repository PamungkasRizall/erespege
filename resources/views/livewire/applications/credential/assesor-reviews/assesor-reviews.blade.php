<main class="main-content w-full px-[var(--margin-x)] pb-8">
    {{-- Header Section --}}
    <div class="flex items-center justify-between space-x-6 py-5 lg:py-6">
        <x-page-header :title="$meta_title" />

        <x-forms.button-add-new @click="$dispatch('open-modal')" text="Berita Acara" />
    </div>

    {{-- Main Content --}}
    <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
        <livewire:tables.assesor-reviews-table category="assessor" />
    </div>

    {{-- Form Modal --}}
    <x-partials.modal class="max-w-xl" head-name="Berita Acara">
        @include('livewire.applications.credential.assesor-reviews.ba-form')
    </x-partials.modal>
</main>
