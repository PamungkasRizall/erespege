<div class="is-scrollbar-hidden min-w-full overflow-x-auto">
    <table class="w-full text-left">
        <thead>
            <tr>
                <th rowspan="2" width="5%" class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                    #
                </th>
                <th rowspan="2" class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                    Rincian Kewenangan Klinis
                </th>
                @isset($showAnswerColumn)
                    @if ($showAnswerColumn)
                    <th colspan="2" class="bg-slate-200 text-center px-3 py-1 text-xs-plus font-medium text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                        Jawaban
                    </th>
                    @endif
                @endisset
            </tr>

            @isset($showAnswerColumn)
                @if ($showAnswerColumn)
                <tr>
                    <th width="5%" class="bg-slate-200 text-center px-3 py-1 text-xs-plus font-medium text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                        User
                    </th>
                    <th width="5%" class="bg-slate-200 text-center px-3 py-1 text-xs-plus font-medium text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                        Ass
                    </th>
                </tr>
                @endif
            @endisset
        </thead>
        <tbody>

            @include('livewire.applications.credential.detail.competence-details', ['details' => $details, 'level' => 0])

        </tbody>
    </table>
</div>
