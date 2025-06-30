<div class="card">
    <p class="mt-6 px-4 text-center">
        <button
            wire:click="$dispatch('confirmModal')"
            id="theEndTest"
            class="badge bg-error text-white w-full">
            AKHIRI ASSESOR REVIEW
        </button>
    </p>
    <div class="my-4 h-px bg-slate-200 dark:bg-navy-500"></div>
    <div class="mt-2 grid grid-cols-3 gap-3 text-center text-xs+">
        <p>Soal</p>
        <p>Terjawab</p>
        <p>Sisa</p>
        <p class="font-medium">{{ $numberOfDetails }}</p>
        <p class="font-medium text-success">{{ countNotNull($assesor_answers) }}</p>
        <p class="font-medium text-error">{{ ($numberOfDetails - countNotNull($assesor_answers)) ?? 0 }}</p>
    </div>
    <div class="my-4 h-px bg-slate-200 dark:bg-navy-500"></div>

    <div
        {{-- style="height: 25rem;" --}}
        class="is-scrollbar min-w-full overflow-x-auto">
        <table class="is-zebra w-full text-left">
            <thead>
                <tr>
                    <th class="whitespace-nowrap bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-4">
                        No
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-4">
                        Jawaban
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-4">
                        Assesor
                    </th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= $numberOfDetails; $i++)
                    @php
                        $answer = $answers[$i] ?? '';
                        $value = $assesor_answers[$i] ?? '';
                    @endphp
                    <tr>
                        <td class="whitespace-nowrap px-3 py-3 sm:px-4" @if (!$value) style="background-color: rgb(255 87 36 / 0.1) !important;" @endif>{{ $i }}.</td>
                        <td class="whitespace-nowrap px-3 py-3 sm:px-4" @if (!$value) style="background-color: rgb(255 87 36 / 0.1) !important;" @endif>{{ $answer }}</td>
                        <td class="whitespace-nowrap px-3 py-3 sm:px-4" @if (!$value) style="background-color: rgb(255 87 36 / 0.1) !important;" @endif>{{ $value }}</td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
