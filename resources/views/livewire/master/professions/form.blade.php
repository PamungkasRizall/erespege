<div class="flex flex-col overflow-y-auto px-4 py-4 sm:px-5 space-y-4">
    <div class="space-y-4">

        {{-- <x-forms.radio-button wire:model="committee" title="Komite" :options="$committees" required /> --}}

        <x-forms.input wire:model="name" title="Nama" required />

        <x-forms.select-box
            wire:model="assesors"
            title="Assesor"
            autocomplete="user"
            multiple
            {{-- :setValues=$assesorsx --}}
            required />

        <div class="space-y-3 text-xs+">
            @if ($profession)
                @foreach ($profession->assesors as $assesor)
                    <p>
                        {{ $loop->iteration }}. {{ $assesor->name }}
                    </p>

                    @if($loop->last)
                        <p class="text-tiny+ text-error">* Isi Kembali Form Assesor</p>
                    @endif
                @endforeach
            @endif
        </div>

        <x-forms.button-submit/>
    </div>
</div>
