<div class="flex flex-col overflow-y-auto space-y-4 sm:space-y-5 lg:space-y-6 p-4">

    @include('livewire.applications.credential.clinical-privileges.ba-expanded')

    @include('livewire.applications.credential.clinical-privileges.recomendation-expanded')

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-12" style="margin-bottom: -2em;">
        <x-forms.flatpickr
            wire:model="recomendation_at"
            title="Tanggal"
            labelClass="sm:col-span-3"
            :options="collect(['dateFormat' => 'Y-m-d', 'enableTime' => false, 'maxDate' => 'today', 'altFormat' =>  'j M Y'])"
            required />

        <x-forms.input
            wire:model="recomendation_code"
            title="No Surat"
            required
            labelClass="sm:col-span-3" />

        <x-forms.input
            wire:model="notes"
            title="Catatan"
            labelClass="sm:col-span-6"
            placeholder="Catatan Jika Ada, Untuk Di Scan Menjadi QRcode" />
    </div>

    <x-forms.button-submit buttonName="Setujui" wireClick="approvalHeadOfCommittee"/>
</div>
