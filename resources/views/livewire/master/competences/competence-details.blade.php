@foreach ($details as $detail)
    <tr>
        <td class="whitespace-nowrap text-center border border-b-0 border-l-0 border-slate-200 px-2 py-2 dark:border-navy-500 lg:px-5">
            @if($detail->type === \App\Enums\CompetenceDetail::UNIT)
                {{ Str::afterLast($detail->full_code, "/") }}.
            @endif
        </td>
        <td class="whitespace-nowrap border border-b-0 border-r-0 border-slate-200 px-2 py-2 dark:border-navy-500 lg:px-5 {{ $detail->type === \App\Enums\CompetenceDetail::GROUP ? 'font-semibold' : '' }}">
            {{-- {!! str_repeat('— ', $level) !!} --}}
            {!! $detail->type === \App\Enums\CompetenceDetail::ELEMENT ? Str::afterLast($detail->full_code, "/").'.&nbsp;&nbsp;&nbsp;&nbsp;' : '' !!}
            {{ $detail->name }}
        </td>
    </tr>

    @if ($detail->children->isNotEmpty())
        @include('livewire.master.competences.competence-details', ['details' => $detail->children, 'level' => $level + 1])
    @endif
@endforeach
