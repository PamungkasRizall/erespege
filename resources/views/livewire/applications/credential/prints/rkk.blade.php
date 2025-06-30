<table class="table-bordered" style="font-weight: normal; font-size: 14.667px; padding-top: 1em; padding-bottom: 1em;" cellspacing="0" cellpadding="4">
    <thead>
        <tr style="font-weight: bold; text-align: center;">
            <td width="5%">No</td>
            <td>Rincian Kewenangan Klinis</td>
            <td width="15%">Kode Nilai</td>
        </tr>
    </thead>
    <tbody>
        @include('livewire.applications.credential.prints.competence-details', ['details' => $filing->competence->details, 'level' => 0])
    </tbody>
</table>

<p>
    <b>Keterangan Kode Nilai:</b>
</p>
<ol style="margin-left: -18px;">
    @foreach ($filing->competence->choices as $choice)
        <li style="font-weight: normal;">{{ $choice->name }}</li>
    @endforeach
</ol>