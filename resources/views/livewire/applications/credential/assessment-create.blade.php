<main class="main-content w-full px-[var(--margin-x)] pb-8">
    {{-- Header Section --}}
    <div class="flex items-center justify-between space-x-6 py-5 lg:py-6">
        <x-page-header :title="$meta_title" />
    </div>

    {{-- Main Content --}}
    <div class="grid grid-cols-12 lg:gap-6">
        <div class="col-span-12 lg:col-span-9 lg:pb-6">
            <div class="card pb-4">
                @php
                    $profile = $user->profile;
                @endphp
                <div class="my-3 flex h-8 items-center justify-between px-4 sm:px-5">
                    <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
                        {{ trim(sprintf('%s %s %s', $profile->doctoral_degree, $user->name, $profile->academic_degree)) }}
                    </h2>
                    <h2 class="border-b border-dotted border-current font-medium tracking-wide text-slate-500 line-clamp-1 dark:text-navy-100 lg:text-base">
                        {{ $profile->functionalPosition->name }}
                    </h2>
                </div>
                <div>
                  {{-- <p class="px-4 sm:px-5">
                    Tables display information in a way that's easy to scan, so that
                    users can look for patterns and insights. Check out code for
                    detail of usage.#f1f5f9
                  </p> --}}
                    <div class="mt-5">

                        @include('livewire.applications.credential.detail.competence', ['details' => $competence->details])

                    </div>
                </div>

              </div>
        </div>

        <div class="col-span-12 pb-6 lg:sticky lg:bottom-0 lg:col-span-3 lg:self-end">
            @if ($model_id)
                @include('livewire.applications.credential.assesor-right-panel')
            @else
                @include('livewire.applications.credential.user-right-panel')
            @endif
        </div>
    </div>

    <x-partials.confirm type="confirm" title="Apakah Anda Yakin Untuk Mengakhiri {{ $model_id ? 'Review' : 'Tes' }} Ini?" action="endTest" />

</main>
