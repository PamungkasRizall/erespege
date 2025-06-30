@foreach ($details as $detail)
    <tr>
        <td style="text-align: center;">
            @if($detail->type === \App\Enums\CompetenceDetail::UNIT)
                {{ Str::afterLast($detail->full_code, "/") }}.
            @endif
        </td>
        <td>
            {!! $detail->type === \App\Enums\CompetenceDetail::ELEMENT ? '<span class="text-slate-700">' . $loop->iteration .'.</span>&nbsp;&nbsp;&nbsp;&nbsp;' : '' !!}

            @if ($detail->type === \App\Enums\CompetenceDetail::GROUP)
                <b>{{ $detail->name }}</b>
            @else
                {{ $detail->name }}
            @endif
        </td>
        @php
            $competenceChoice = $filing->answers->where('competence_detail_id', $detail->id)->first();
        @endphp
        <td style="text-align: center;">
            {{ $competenceChoice?->assessor_choice?->sequence }}
        </td>
    </tr>

    @if ($detail->children->isNotEmpty())
        @include('livewire.applications.credential.prints.competence-details', ['details' => $detail->children, 'level' => $level + 1])
    @endif
@endforeach
