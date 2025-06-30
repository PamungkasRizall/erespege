<div class="flex flex-col overflow-y-auto px-4 py-4 sm:px-5 space-y-4">
    <div class="space-y-4">

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
            <x-forms.flatpickr
                wire:model="date_at"
                title="Tanggal"
                labelClass="sm:col-span-4"
                :options="collect(['dateFormat' => 'Y-m-d', 'enableTime' => false, 'maxDate' => 'today', 'altFormat' =>  'j M Y'])"
                required />

            <x-forms.input
                wire:model="location"
                title="Lokasi"
                labelClass="sm:col-span-8"
                required />
        </div>

        <x-forms.select-box
            wire:model="filings"
            title="Peserta"
            autocomplete="filing-user"
            multiple
            required />

        <x-forms.button-submit/>
    </div>
</div>
