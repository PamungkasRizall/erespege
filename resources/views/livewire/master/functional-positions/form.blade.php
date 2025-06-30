<div class="flex flex-col overflow-y-auto px-4 py-4 sm:px-5 space-y-4">
    <div class="space-y-4">

        <x-forms.select-box
            wire:model="profession_id"
            title="Profesi"
            :options="$professions"
            basic
            required
            placeholder="Pilih Profesi" />

        <x-forms.input wire:model="name" title="Nama" required />

        <x-forms.button-submit/>
    </div>
</div>

