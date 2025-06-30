<main class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="flex items-center justify-between space-x-6 py-5 lg:py-6">
        <x-page-header :title="$meta_title" />

    </div>

    <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
        <div class="col-span-12 lg:col-span-4 space-y-2">

            @include('livewire.profile.form-account')

        </div>
        <div class="col-span-12 lg:col-span-8">

            @if (!auth()->user()->profile_completed)
                @include('livewire.profile.information', ['color' => 'warning', 'msg' => 'Lengkapi profile untuk mengakses menu yang lain.'])
            @endif

            @if (session()->has('message'))
                @include('livewire.profile.information', ['color' => 'error', 'msg' => session('message')])
            @endif

            @include('livewire.profile.form')

        </div>
    </div>
</main>
