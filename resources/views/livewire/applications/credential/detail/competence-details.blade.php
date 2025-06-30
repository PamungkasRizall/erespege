@foreach ($details as $detail)
    <tr class="
        @if (!$level)
            bg-warning/10 text-slate-700
         @elseif ($level == 1)
            bg-info/10 text-slate-700
         @endif
    ">
        <td class="whitespace-nowrap border border-t-0 border-slate-200 px-2 py-2 sm:px-5">
            @if($detail->type === \App\Enums\CompetenceDetail::UNIT)
                {{ Str::afterLast($detail->full_code, "/") }}.
            @endif
        </td>
        <td class="whitespace-nowrap border border-t-0 border-slate-200 px-2 py-2 sm:px-5">
            {{-- {!! str_repeat('— ', $level) !!} --}}
            {!! $detail->type === \App\Enums\CompetenceDetail::ELEMENT ? '<span class="text-slate-700">' . $loop->iteration .'.</span>&nbsp;&nbsp;&nbsp;&nbsp;' : '' !!}
            {{ $detail->name }}

            @if ($detail->type === \App\Enums\CompetenceDetail::ELEMENT)

                @isset($showAnswerColumn)
                    @if ($showAnswerColumn)
                        @php
                            $competenceChoiceNotes = $showAnswerColumn->where('competence_detail_id', $detail->id)->first()->ass_notes;
                        @endphp
                        @if ($competenceChoiceNotes)
                            <br/>
                            <div class="badge mt-1 bg-error/10 py-1 px-1.5 text-error dark:bg-error/15">
                                <span>Catatan: {{ $competenceChoiceNotes }}</span>
                            </div>
                        @endif
                    @endif
                @endisset

                @isset($answers)
                    @include('livewire.applications.credential.choices', ['competenceDetailId' => $detail->id])
                @endisset
            @endif
        </td>

        @isset($showAnswerColumn)
            @if ($showAnswerColumn)
                @php
                    $competenceChoice = $showAnswerColumn->where('competence_detail_id', $detail->id)->first();
                @endphp
                <td class="whitespace-nowrap text-center border border-t-0 border-slate-200 px-2 py-2 sm:px-5">
                    {{ $competenceChoice?->choice?->sequence }}
                </td>
                <td class="whitespace-nowrap text-center border border-t-0 border-slate-200 px-2 py-2 sm:px-5">
                    {{ $competenceChoice?->assessor_choice?->sequence }}
                </td>
            @endif
        @endisset
    </tr>

    @if ($detail->children->isNotEmpty())
        @include('livewire.applications.credential.detail.competence-details', ['details' => $detail->children, 'level' => $level + 1])
    @endif
@endforeach
