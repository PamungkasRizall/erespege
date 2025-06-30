<div class="mt-3 ml-7 grid grid-cols-1 place-items-start gap-2 sm:grid-cols-1">
    @foreach ($competence->choices as $choice)
        <label class="inline-flex items-center space-x-3">
            <span>{{ chr(64+ $loop->iteration) }}. </span>
            <input
                @if (!$isAssesor)
                    wire:click="$dispatch('setAnswer', { value: $event.target.value, detail: '{{ $competenceDetailId }}', serial_number: '{{ $detail->serial_number }}' })"
                    id="choice_{{ $competenceDetailId }}_{{ $loop->index }}"
                    name="answers_{{ $competenceDetailId}}"
                @else
                    disabled
                @endif

                wire:model="answers.{{ $detail->serial_number }}"
                class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                value="{{ chr(64+ $loop->iteration) }}"
                type="radio" />

            @if ($isAssesor)
                <input
                    wire:click="$dispatch('setAnswerAssessor', { value: $event.target.value, detail: '{{ $competenceDetailId }}', serial_number: '{{ $detail->serial_number }}' })"
                    id="success_{{ $competenceDetailId }}_{{ $loop->index }}"
                    name="assesor_answers_{{ $competenceDetailId}}"
                    wire:model="assesor_answers.{{ $detail->serial_number }}"
                    class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-success checked:bg-success hover:border-success focus:border-success dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                    value="{{ chr(64+ $loop->iteration) }}"
                    type="radio" />
            @endif

            <span>{{ $choice->name }}</span>
        </label>
    @endforeach
</div>

@can('assessor-create')
    <x-forms.input
        wire:model.blur="notes_assessor_answers.{{ $competenceDetailId }}"
        {{-- wire:click="$dispatch('setAnswerAssessorNote', { value: $event.target.value, detail: '{{ $competenceDetailId }}', serial_number: '{{ $detail->serial_number }}' })" --}}
        maxlength="255"
        placeholder="Catatan Assesor" />
@endcan
