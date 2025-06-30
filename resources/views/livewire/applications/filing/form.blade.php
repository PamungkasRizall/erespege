<div class="is-scrollbar min-w-full overflow-x-auto">
    <div class="flex flex-col overflow-y-auto px-4 py-4 sm:px-5 space-y-4">

        <x-forms.input
            wire:model="letter_no"
            title="No Surat"
            placeholder=""
            maxlength="50"
            required />

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

            <x-forms.flatpickr
                wire:model.live="start_date"
                title="Tgl Awal Berlaku"
                :options="collect(['dateFormat' => 'Y-m-d', 'enableTime' => false, 'altFormat' =>  'j M Y'])"
                required />

            <label class="inline-flex items-center space-x-2 mt-6">
                <input
                    wire:model.live="is_end"
                    class="form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                    type="checkbox"
                    value="true"
                />
                <span class="text-tiny+ text-error">Ada Tgl Akhir Berlaku?</span>
            </label>

            @if ($is_end)
                <x-forms.flatpickr
                    wire:model.live="end_date"
                    title="Tgl Akhir Berlaku"
                    :options="collect(['dateFormat' => 'Y-m-d', 'enableTime' => false, 'altFormat' =>  'j M Y'])"
                    required />
            @endif

        </div>

        <x-forms.input
            wire:model="file"
            placeholder=""
            title="Upload File (max: 2 MB)"
            type="file"
            required />

        <x-forms.button-submit/>
    </div>
</div>
