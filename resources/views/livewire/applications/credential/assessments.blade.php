<main class="main-content w-full px-[var(--margin-x)] pb-8">
    {{-- Header Section --}}
    <div class="flex items-center justify-between space-x-6 py-5 lg:py-6">
        <x-page-header :title="$meta_title" />
    </div>

    {{-- Main Content --}}
    @if (session()->has('message'))
        @include('livewire.profile.information', ['color' => 'error', 'msg' => session('message')])
    @endif

    <div class="grid grid-cols-1">
        @include('livewire.applications.credential.welcome')

        <livewire:applications.filing :key="time()">

        <livewire:tables.assessments-table />
    </div>

</main>
