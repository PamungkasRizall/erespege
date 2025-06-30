<div class="card p-4 sm:p-5">
    <div class="flex items-center space-x-4">
        <div class="avatar size-14">
            <img class="rounded-full" src="{{ asset('images/users/male.png') }}" alt="avatar">
        </div>
        <div>
            <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                {{ auth()->user()->name }}
            </h3>
            <p class="text-xs+">NIP : {{ auth()->user()->nip }}</p>
        </div>
    </div>

    <div class="mt-4 space-y-4">

        <p class="text-base font-medium text-slate-700 dark:text-navy-100">
            Pengaturan Akun
        </p>

        <x-forms.input wire:model="username" title="Username" required placeholder="Tanpa Spasi" />

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

            <x-forms.input wire:model="password" title="Password" type="password" required />

            <x-forms.input wire:model="password_confirmation" title="Konfirmasi Password" type="password" required />

        </div>

        <x-forms.button-submit
            wireClick="storeAccount"
            disableCancelButton=true
            buttonName="Update" />
    </div>
</div>
