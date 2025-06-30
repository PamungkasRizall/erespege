<div class="flex flex-col overflow-y-auto px-4 py-4 sm:px-5">
    <div class="mt-4 space-y-4">

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
            <x-forms.input
                wire:model="code"
                title="Kode Buku"
                labelClass="sm:col-span-3"
                required />

            <x-forms.select-box
                wire:model.live="profession_id"
                :options="$professions"
                title="Profesi"
                labelClass="sm:col-span-4"
                required />

            <x-forms.select-box
                wire:model="functional_position_id"
                :options="$functionalPositions"
                title="Kompetensi"
                labelClass="sm:col-span-5"
                required />
        </div>

        <x-forms.filepond
            wire:model="file"
            allowImagePreview
            allowFileTypeValidation
            acceptedFileTypes="['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']"
        />

        <div class="flex items-center justify-between">
            @error('file')
                <span class="text-tiny+ text-error">
                    {{ $message }}
                </span>
            @else
                <span></span>
            @enderror

            <button
                wire:click.prevent="download"
                class="btn h-8 space-x-2 text-error p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 sm:h-9"
                style="margin-top: -10px;"
            >
                <span>Download Template Kompetensi</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13.5l3 3m0 0l3-3m-3 3v-6m1.06-4.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"></path>
                </svg>
            </button>
        </div>

        <div class="my-3 flex items-center space-x-3">
            <div class="h-px flex-1 bg-slate-200 dark:bg-navy-500"></div>
            <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">Pilihan Jawaban</h2>
            <div class="h-px flex-1 bg-slate-200 dark:bg-navy-500"></div>
        </div>

        @for ($i = 0; $i < \App\Models\Choice::NUMBER_OF_CHOICES_PER_QUESTION; $i++)
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
            @php
                $no = $i + 1;
            @endphp
            <x-forms.input
                wire:model="choices.{{ $i }}.name"
                title="Jawaban {{ $no }}."
                labelClass="sm:col-span-10"
                required />

            <x-forms.input
                wire:model="choices.{{ $i }}.score"
                title="Nilai {{ $no }}."
                class="text-right"
                labelClass="sm:col-span-2"
                x-data
                x-init="new Cleave($el, { numeral: true, delimiter: '' })"
                required />

        </div>
        @endfor

        @error('choices')
            <div class="text-center text-tiny+ text-error">{{ $message }}</div>
        @enderror

        <x-forms.button-submit/>
    </div>
</form>
</div>
