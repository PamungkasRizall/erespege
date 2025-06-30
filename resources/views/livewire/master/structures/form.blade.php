<div class="flex flex-col overflow-y-auto px-4 py-4 sm:px-5 space-y-4">
    <div class="space-y-4">

        <x-forms.radio-button wire:model="isUnique" title="Posisi hanya diisi satu orang?" :options="$uniques" required />

        <x-forms.radio-button wire:model="isMain" title="Posisi utama?" :options="$primaries" required />

        <x-forms.select-box
            wire:model="departmentId"
            title="Unit"
            :options="$departments"
            required
            placeholder="Pilih Unit Terkait" />

        <x-forms.input wire:model="name" title="Nama" required />

        <x-forms.select-box
            wire:model="parentId"
            title="Parent"
            :options="$headOfs"
            required
            placeholder="Pilih Atasan Jika Ada" />

        <x-forms.button-submit/>
    </div>
</div>
