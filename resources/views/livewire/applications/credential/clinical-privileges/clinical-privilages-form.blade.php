<div class="flex flex-col overflow-y-auto space-y-4 sm:space-y-5 lg:space-y-6 p-4">

    @include('livewire.applications.credential.clinical-privileges.ba-expanded')

    @include('livewire.applications.credential.clinical-privileges.recomendation-expanded')

    @include('livewire.applications.credential.clinical-privileges.clinical-privilages-expanded')

    @isset($showForm)
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-12" style="margin-bottom: -2em;">
            <x-forms.flatpickr
                wire:model="cp_at"
                title="Tanggal"
                labelClass="sm:col-span-2"
                :options="collect(['dateFormat' => 'Y-m-d', 'enableTime' => false, 'maxDate' => 'today', 'altFormat' =>  'j M Y'])"
                required />

            <x-forms.input
                wire:model="letter_no"
                title="No Surat"
                required
                labelClass="sm:col-span-5" />
        </div>

        <x-forms.button-submit buttonName="Buat Surat" wireClick="createLetterClinicalPrivileges"/>
    @endisset
</div>
