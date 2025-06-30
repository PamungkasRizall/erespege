<main class="main-content w-full px-[var(--margin-x)] pb-8">
    {{-- Header Section --}}
    <div class="flex items-center justify-between space-x-6 py-5 lg:py-6">
        <x-page-header :title="$meta_title" />
    </div>

    {{-- Main Content --}}
    <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
        <livewire:tables.clinical-privileges-table />
    </div>

    {{-- Form Modal --}}
    <x-partials.modal class="max-w-4xl" modal-key="review" head-name="Preview - Sub Komite">
        @if ($modelId && $isSubCommittee)
            @include('livewire.applications.credential.clinical-privileges.ba-form')
        @endif
    </x-partials.modal>

    <x-partials.modal class="max-w-4xl" modal-key="review-ketua" head-name="Preview - Ketua Komite">
        @if ($modelId && !$isSubCommittee)
            @include('livewire.applications.credential.clinical-privileges.recomendation-form')
        @endif
    </x-partials.modal>

    <x-partials.modal class="max-w-4xl" modal-key="clinical-privilages" head-name="Preview - Sub Komite - Clinical Privileges">
        @if ($modelId && $isSubCommittee)
            @include('livewire.applications.credential.clinical-privileges.clinical-privilages-form', ['showForm' => true])
        @endif
    </x-partials.modal>

    <x-partials.modal class="max-w-4xl" modal-key="print-done-all" head-name="Print All - Clinical Privileges">
        @if ($modelId)
            @include('livewire.applications.credential.clinical-privileges.clinical-privilages-form')
        @endif
    </x-partials.modal>

    <x-partials.modal class="max-w-xl" head-name="Form Upload File Clinical Privilege TTD Dirut" modal-key="form-upload">
        @if ($modelId && $isSubCommittee)
        <div class="card sm:order-last sm:col-span-2 lg:order-none lg:col-span-1 mt-4">
            <div class="space-y-4 py-3 px-4 sm:px-5">

                <x-forms.filepond
                    wire:model="file"
                    allowFileTypeValidation
                    acceptedFileTypes="['application/pdf']"
                    allowFileSizeValidation
                    required
                    maxFileSize="2mb" />

                @error('file') <span class="text-error py-5">{{ $message }}</span> @enderror

                <div class="flex items-center justify-between">
                    <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">

                    </h2>

                    {{-- Button --}}
                    <x-forms.button-submit wire-click="storeFileUpload"/>
                </div>
            </div>
        </div>
        @endif
    </x-partials.modal>
</main>
