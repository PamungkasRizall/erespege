<div class="card px-4 sm:px-5" x-data="{expanded:true}">
    <div class="my-3 flex h-8 items-center justify-between" @click="expanded = !expanded">
        <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
            Pengaturan Profile
        </h2>
        <div
            :class="expanded && '-rotate-180'"
            class="text-sm font-normal leading-none text-primary transition-transform duration-300 dark:text-navy-300"
        >
            <i class="fas fa-chevron-down"></i>
        </div>
    </div>
    <div x-collapse x-show="expanded">
        <div class="my-4 space-y-4">

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">

                <x-forms.input
                    wire:model="nik"
                    title="NIK"
                    labelClass="sm:col-span-3"
                    x-data
                    x-init="new Cleave($el, { numeral: true, delimiter: '' })"
                    required
                    maxlength="16" />

                <x-forms.input
                    wire:model="place_of_birth"
                    title="Tempat Lahir"
                    labelClass="sm:col-span-6"
                    required
                    maxlength="30" />

                <x-forms.flatpickr
                    wire:model.live="date_of_birth"
                    title="Tanggal Lahir"
                    labelClass="sm:col-span-3"
                    :options="collect(['dateFormat' => 'Y-m-d', 'enableTime' => false, 'altFormat' =>  'j M Y'])"
                    required />

            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                <x-forms.radio-button
                    wire:model="gender"
                    title="Jenis Kelamin"
                    :options="$genders"
                    required />

                <x-forms.input
                    wire:model="doctoral_degree"
                    title="Gelar Depan" />

                <x-forms.input
                    wire:model="academic_degree"
                    title="Gelar Belakang"
                    placeholder="S.T., S.Tr.RMIK"
                    required />

            </div>

            <x-forms.input wire:model="address" title="Alamat" required />

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                <x-forms.input
                    wire:model="province"
                    title="Provinsi"
                    required />

                <x-forms.input
                    wire:model="city"
                    title="Kab / Kota"
                    required />

                <x-forms.input
                    wire:model="subdistrict"
                    title="Kecamatan"
                    required />

            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                <x-forms.input
                    wire:model="district"
                    title="Kelurahan"
                    required />

                <x-forms.input
                    wire:model="phone"
                    title="No Telpon"
                    placeholder="628..."
                    maxlength="15"
                    required />

                <x-forms.input
                    wire:model="phone_emergency"
                    title="No Telpo Darurat"
                    placeholder="628..."
                    maxlength="15"
                    required />
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                <x-forms.select-box
                    wire:model.live="profession_id"
                    :options="$professions"
                    title="Profesi"
                    required />

                <x-forms.select-box
                    wire:model="functional_position_id"
                    :options="$functionalPositions"
                    title="Kompetensi"
                    required />

                <x-forms.select-box
                    wire:model="employee_status_id"
                    :options="$employeeStatuses"
                    title="Status Pegawai"
                    required />
            </div>

            <x-forms.button-submit
                disableCancelButton=true
                buttonName="{{ $model_id ? 'Update' : 'Simpan' }}" />

        </div>
    </div>
</div>
