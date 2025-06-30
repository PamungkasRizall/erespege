<main class="main-content w-full px-[var(--margin-x)] pb-8">
    {{-- Header Section --}}
    <div class="flex items-center justify-between space-x-6 py-5 lg:py-6">
        <x-page-header :title="$meta_title" />
    </div>

    {{-- Main Content --}}
    <div class="grid grid-cols-1">

        <livewire:tables.manual-filings-table :categories=$categories />
    </div>

    <x-partials.confirm type="confirm" title="Apakah dokumen sudah sesuai semua?" action="approveDocument" />

</main>
