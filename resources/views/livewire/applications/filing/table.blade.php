<p class="max-w-xl">
    Syarat Pengajuan Assesmen Kredensial:
</p>
<div class="is-scrollbar-hidden min-w-full overflow-x-auto rounded-lg border border-slate-200 dark:border-navy-500" x-data="{ iframeSrc: '' }">
    <table class="w-full text-left">
        <thead>
            <tr>
                <th class="whitespace-nowrap border border-t-0 border-l-0 border-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:border-navy-500 dark:text-navy-100 lg:px-5">
                    No
                </th>
                <th class="whitespace-nowrap border border-t-0 border-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:border-navy-500 dark:text-navy-100 lg:px-5">
                    Dokumen
                </th>
                <th class="whitespace-nowrap border border-t-0 border-r-0 border-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:border-navy-500 dark:text-navy-100 lg:px-5">
                    Status
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $key => $value)

                @php
                    $filing = $filings->where('category_id', $key)?->first();
                    $isCurrentUser = $filing?->user_id === Auth::id();
                    $subCommittee = $filing?->status === \App\Enums\FilingStatus::SUB_COMMITTEE;
                @endphp
            <tr>
                <td class="whitespace-nowrap border border-l-0 border-slate-200 px-3 py-3 dark:border-navy-500 lg:px-5">
                    {{ $loop->iteration }}
                </td>
                <td class="whitespace-nowrap border border-slate-200 px-3 py-3 dark:border-navy-500 lg:px-5">
                    {{ $value }}

                    @isset($form)
                        @if ($value == \App\Models\Filing::KREDENSIAL)
                            <p class="text-tiny+ text-error">Abaikan Jika Kamu Baru Pertama Kali Melakukan Assesmen Kredensial</p>
                        @else
                            <span class="text-tiny+ text-error">*</span>
                        @endif
                    @endisset
                </td>
                <td class="whitespace-nowrap border border-r-0 border-slate-200 px-3 py-3 dark:border-navy-500 lg:px-5">
                    @if ($filing)
                        @php
                            $color = $filing->status->color();
                            $text = $filing->status->naming();
                        @endphp

                        <div class="badge bg-{{$color}}/10 text-{{$color}} dark:bg-{{$color}}/15">
                            {{ $text }}
                        </div>
                    @else
                        @if(isset($form))
                        <button
                            wire:click="$dispatch('modalFormUpload', { id: '{{ $key }}' })"
                            class="badge mb-1 space-x-2 bg-primary text-white dark:bg-accent"
                        >
                            <span>Upload Berkas</span>
                        </button>
                        @else
                        <div class="badge bg-error/10 text-error dark:bg-error/15">
                            Belum Diupload
                        </div>
                        @endif
                    @endif

                    @if ($filing?->hyperlink)
                        <a
                            {{-- @click="$dispatch('open-modal', { modalKey: 'document-preview', value: '{{ $filing->hyperlink }}' })" --}}
                            href="{{ $filing->hyperlink }}"
                            target="_blank"
                            x-tooltip.primary="'Lihat Dokumen'"
                            class="btn h-6 w-8 p-0 text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mt-px h-4.5 w-4.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                            </svg>
                        </a>
                    @endif

                    @if ($subCommittee)
                        <button
                            wire:click="$dispatch('delete', { id: '{{ $filing->id }}' })"
                            x-tooltip.error="'Hapus Dokumen'"
                            class="btn h-6 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mt-px h-4.5 w-4.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal to show document preview (iframe) -->
    <x-partials.modal class="max-w-4xl" modal-key="document-preview" head-name="Dokumen">
        <!-- Listen for the event to update iframe -->
        <div x-init="$watch('$dispatch', (event) => { if (event.detail.modalKey === 'document-preview') { iframeSrc = event.detail.value; } })">
            <iframe :src="iframeSrc" width="100%" height="400" frameborder="0"></iframe>
        </div>
    </x-partials.modal>
</div>

