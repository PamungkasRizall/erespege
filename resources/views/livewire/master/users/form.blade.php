<div class="flex flex-col overflow-y-auto px-4 py-4 sm:px-5 space-y-4">

    <x-forms.input wire:model="name" title="Nama" required placeholder="Nama Lengkap Tanpa Gelar" />

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

        <x-forms.input wire:model="username" title="Username" required placeholder="Tanpa Spasi" />

        <x-forms.input wire:model="nip" title="NIP" maxlength="18" required />

    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

        <x-forms.input wire:model="password" title="Password" type="password" required />

        <x-forms.input wire:model="password_confirmation" title="Konfirmasi Password" type="password" required />

    </div>

    <x-forms.select-box
        wire:model="structureId"
        title="Jabatan/Posisi Utama"
        :options="$structures"
        required />

    {{-- <x-forms.select-box wire:model="roles" title="Roles" :options="$roleList" multiple placeholder="Pilih role" /> --}}

    <x-forms.button-submit/>
</div>
