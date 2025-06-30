<div class="card">
    <p class="mt-6 px-4 font-medium">Waktu Tersisa</p>
    <div
        class="mt-3 grid grid-cols-3 gap-3 px-4 text-center font-inter text-4xl font-semibold text-primary dark:text-accent-light"
        x-data="timer({{ $countDown }})"
        x-init="init();"
    >
        <div class="grid gap-1">
            <div class="rounded-lg bg-primary/10 py-3 dark:bg-accent-light/10" x-text="time().hours">

            </div>
        </div>
        <div class="grid gap-1">
            <div class="rounded-lg bg-primary/10 py-3 dark:bg-accent-light/10" x-text="time().minutes">

            </div>
        </div>
        <div class="grid gap-1">
            <div class="rounded-lg bg-primary/10 py-3 dark:bg-accent-light/10" x-text="time().seconds">

            </div>
        </div>
    </div>
    <div class="mt-2 grid grid-cols-3 gap-3 text-center text-xs+">
        <p>jam</p>
        <p>menit</p>
        <p>detik</p>
    </div>

    <p class="mt-6 px-4 text-center">
        <button
            wire:click="$dispatch('confirmModal')"
            id="theEndTest"
            class="badge bg-error text-white w-full">
            AKHIRI ASSESMEN MANDIRI
        </button>
    </p>
    <div class="my-4 h-px bg-slate-200 dark:bg-navy-500"></div>
    <div class="mt-2 grid grid-cols-3 gap-3 text-center text-xs+">
        <p>Soal</p>
        <p>Terjawab</p>
        <p>Sisa</p>
        <p class="font-medium">{{ $numberOfDetails }}</p>
        <p class="font-medium text-success">{{ countNotNull($answers) }}</p>
        <p class="font-medium text-error">{{ ($numberOfDetails - countNotNull($answers)) ?? 0 }}</p>
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
                        $value = $answers[$i] ?? '';
                    @endphp
                    <tr>
                        <td class="whitespace-nowrap px-3 py-3 sm:px-4" @if (!$value) style="background-color: rgb(255 87 36 / 0.1) !important;" @endif>{{ $i }}.</td>
                        <td class="whitespace-nowrap px-3 py-3 sm:px-4" @if (!$value) style="background-color: rgb(255 87 36 / 0.1) !important;" @endif>{{ $value }}</td>
                        <td class="whitespace-nowrap px-3 py-3 sm:px-4" @if (!$value) style="background-color: rgb(255 87 36 / 0.1) !important;" @endif>{{ '' }}</td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        // set timer interval variable
        var refreshIntervalId;

        function timer(expiry)
        {
            return {
                expiry: expiry,
                remaining:null,
                init() {
                    this.setRemaining()
                    refreshIntervalId = setInterval(() => {
                        this.setRemaining();
                    }, 1000);
                },
                setRemaining() {
                    const diff = this.expiry - new Date().getTime();
                    this.remaining =  parseInt(diff / 1000);
                    if (this.remaining < 1)
                    {
                        console.log('The End Test');
                        // document.getElementById("theEndTest").click();
                        location.reload();
                    }
                },
                days() {
                    return {
                        value:this.remaining / 86400,
                        remaining:this.remaining % 86400
                    };
                },
                hours() {
                    return {
                        value:this.days().remaining / 3600,
                        remaining:this.days().remaining % 3600
                    };
                },
                minutes() {
                    return {
                        value:this.hours().remaining / 60,
                        remaining:this.hours().remaining % 60
                    };
                },
                seconds() {
                    return {
                        value:this.minutes().remaining,
                    };
                },
                format(value) {
                    return ("0" + parseInt(value)).slice(-2)
                },
                time(){
                    return {
                        hours:this.format(this.hours().value),
                        minutes:this.format(this.minutes().value),
                        seconds:this.format(this.seconds().value),
                    }
                },
            }
        }
    </script>
@endpush
